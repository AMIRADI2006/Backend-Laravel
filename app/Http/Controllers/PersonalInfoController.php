<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function response;

class PersonalInfoController extends Controller
{
//    // لیست همه اطلاعات شخصی (فقط برای ادمین یا تست)
//    public function index()
//    {
//        return response()->json([
//            'message' => 'All personal infos fetched',
//            'data' => PersonalInfo::all()
//        ]);
//    }

    // ایجاد اطلاعات شخصی جدید برای کاربر لاگین‌شده
    public function store(Request $request)
    {
        $validatedInfo = $request->validate([
            'phone'          => 'required|string|max:50',
            'location'       => 'required|string|max:150',
            'birth_year'     => 'required|digits:4',
            'marital_status' => 'required|in:Single,Married',
            'gender'         => 'required|in:Male,Female',
        ]);

        $personalInfo = PersonalInfo::create(array_merge(
            $validatedInfo,
            ['user_id' => $request->user()->id]
        ));

        $user = $request->user();

        return response()->json([
            'message' => 'Personal info created successfully',
            'profile' => [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'email'         => $user->email,
                'phone'         => $personalInfo->phone,
                'location'      => $personalInfo->location,
                'birth_year'    => $personalInfo->birth_year,
                'marital_status'=> $personalInfo->marital_status,
                'gender'        => $personalInfo->gender,
            ]
        ], 201);
    }

    // نمایش اطلاعات کامل کاربر لاگین‌شده
    public function show(Request $request)
    {
        $user = $request->user();
        $personalInfo = PersonalInfo::where('user_id', $user->id)->first();

        return response()->json([
            'message' => 'Profile fetched',
            'profile' => [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'email'         => $user->email,
                'phone'         => $personalInfo->phone ?? null,
                'location'      => $personalInfo->location ?? null,
                'birth_year'    => $personalInfo->birth_year ?? null,
                'marital_status'=> $personalInfo->marital_status ?? null,
                'gender'        => $personalInfo->gender ?? null,
            ]
        ]);
    }

    // بروزرسانی همزمان اطلاعات اصلی و تکمیلی
    public function update(Request $request)
    {
        $user = $request->user();

        // اعتبارسنجی اطلاعات اصلی
        $validatedUser = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|confirmed|min:6',
        ]);

        // اعتبارسنجی اطلاعات تکمیلی
        $validatedInfo = $request->validate([
            'phone'          => 'required|string|max:50',
            'location'       => 'required|string|max:150',
            'birth_year'     => 'required|digits:4',
            'marital_status' => 'required|in:Single,Married',
            'gender'         => 'required|in:Male,Female',
        ]);

        // آپدیت اطلاعات اصلی
        if (!empty($validatedUser['password'])) {
            $validatedUser['password'] = Hash::make($validatedUser['password']);
        } else {
            unset($validatedUser['password']);
        }
        $user->update($validatedUser);

        // آپدیت یا ایجاد اطلاعات تکمیلی
        $personalInfo = PersonalInfo::updateOrCreate(
            ['user_id' => $user->id],
            $validatedInfo
        );

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => [
                'id'            => $user->id,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'email'         => $user->email,
                'phone'         => $personalInfo->phone,
                'location'      => $personalInfo->location,
                'birth_year'    => $personalInfo->birth_year,
                'marital_status'=> $personalInfo->marital_status,
                'gender'        => $personalInfo->gender,
            ]
        ]);
    }

    // حذف اطلاعات شخصی کاربر لاگین‌شده
    public function destroy(Request $request)
    {
        $personalInfo = PersonalInfo::where('user_id', $request->user()->id)->first();

        if ($personalInfo) {
            $personalInfo->delete();
            return response()->json([
                'message' => 'Personal info deleted successfully'
            ]);
        }

        return response()->json([
            'message' => 'No personal info found'
        ], 404);
    }
}

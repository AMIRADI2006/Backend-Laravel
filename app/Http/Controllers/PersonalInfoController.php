<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class PersonalInfoController extends Controller
{
    // GET /api/v1/personal-info
    public function show()
    {
        // اگر چند رکورد نباشه، رکورد اول را برگردان
        $info = PersonalInfo::first();
        if (!$info) {
            return response()->json(['data' => null], 200);
        }
        return response()->json(['data' => $info], 200);
    }

    // PUT /api/personal-info
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'marital_status' => 'nullable|in:Married,Single',
            'gender' => 'nullable|in:Female,Male,Other',
            'birth_year' => 'nullable|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // رکورد اول یا ایجاد جدید
        $info = PersonalInfo::first();
        if (!$info) {
            $info = new PersonalInfo();
        }

        $info->fill($request->only([
            'first_name','last_name','job_title','email','phone',
            'location','linkedin','portfolio','marital_status','gender','birth_year'
        ]));

        $info->save();

        return response()->json(['data' => $info], 200);
    }
}

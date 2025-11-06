<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    public function createToken(User $user)
    {
        $userToken = $user->createToken('User | Api');
        return response()->json([
            'message'=>'توکن کاربر با موفقیت صادر شد',
            'token' => $userToken->plainTextToken,
            'user'=> $user
        ],200);
    }


    public function update(UserUpdateRequest $userUpdateRequest,User $user)
    {
        //dd($userUpdateRequest->all());

        $user->update($userUpdateRequest->all());
        $user=User::find($user->id);
        return response()->json([
            'message'=>'Update Info User has been Successfully ...',
            'data'=> new UserInfoRequest($user)
        ]);
    }
}

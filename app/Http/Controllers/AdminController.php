<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreValidation;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    //
    public function store(AdminStoreValidation $adminStoreValidation)
    {
//        dd($request->name);

        $Admin = Admin::create($adminStoreValidation->all());
        return response()->json([
            'message' => 'create admin has been successfully !',
            'data' => $Admin
        ]);
    }


    public function show(Admin $admin)
    {
        return response()->json([
            'message'=> 'admin has been fetch',
            'data'=> $admin
        ]);
    }


    public function update(Admin $admin , AdminStoreValidation $adminStoreValidation)
    {
        $admin->update(\request()->all());
        $admin = Admin::find($admin->id);
        return response()->json([
            'message' => 'update admin has been successfully',
            'data' => $admin
        ]);
    }


    public function delete(Admin $admin)
    {
        $admin->delete();
        return response()->json([
            'message' => 'delete admin has been successfully'
        ]);
    }
}

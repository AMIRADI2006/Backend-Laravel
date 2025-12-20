<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    AuthController,
    CategoryController,
    CompanyController,
    JobController,
    PersonalInfoController,
    ProductController
};

Route::apiResource('product', ProductController::class);
Route::apiResource('job', JobController::class);
Route::apiResource('admin', AdminController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('company', CompanyController::class);

// ثبت کاربر جدید + دریافت توکن
Route::post('/register', [AuthController::class, 'register']);

// ورود کاربر + دریافت توکن
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // 🔹 اطلاعات کاربر لاگین‌شده
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    // 🔹 خروج کاربر
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/personal-info', [PersonalInfoController::class, 'show']);
    Route::post('/personal-info', [PersonalInfoController::class, 'store']);
    Route::put('/personal-info', [PersonalInfoController::class, 'update']);
    Route::delete('/personal-info', [PersonalInfoController::class, 'destroy']);

//    Route::apiResource('personal-info', PersonalInfoController::class);

//    Route::get('/personal-info', [PersonalInfoController::class, 'show']);
//    Route::put('/personal-info', [PersonalInfoController::class, 'update']);
});

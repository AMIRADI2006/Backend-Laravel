<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AboutMeController,
    AdminController,
    AuthController,
    CategoryController,
    CompanyController,
    JobController,
    PersonalInfoController,
    ProductController,
    ProfessionalSkillController};

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

    //  خروج کاربر
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/personal-info', [PersonalInfoController::class, 'show']);
    Route::post('/personal-info', [PersonalInfoController::class, 'store']);
    Route::put('/personal-info', [PersonalInfoController::class, 'update']);
    Route::delete('/personal-info', [PersonalInfoController::class, 'destroy']);

    //  About Me
    Route::get('/about-me', [AboutMeController::class, 'show']);
    Route::post('/about-me', [AboutMeController::class, 'store']);
    Route::delete('/about-me', [AboutMeController::class, 'destroy']);

    //  Professional Skills
    Route::get('/professional-skills', [ProfessionalSkillController::class, 'show']);
    Route::post('/professional-skills', [ProfessionalSkillController::class, 'store']);
    Route::delete('/professional-skills', [ProfessionalSkillController::class, 'destroy']);
    Route::delete('/professional-skills/{skill}', [ProfessionalSkillController::class, 'remove']);



});

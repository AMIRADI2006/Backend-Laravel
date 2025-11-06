<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/product/store' , [\App\Http\Controllers\ProductController::class , 'store']);
Route::get('/product/{product}/show' , [\App\Http\Controllers\ProductController::class , 'show']);
Route::put('/product/{product}/update' , [\App\Http\Controllers\ProductController::class , 'update']);
Route::delete('/product/{product}/delete' , [\App\Http\Controllers\ProductController::class , 'delete']);

Route::get('/job', [JobController::class, 'index']);

Route::post('/job/store' , [JobController::class , 'store']);
Route::get('/job/{job}/show' , [JobController::class , 'show']);
Route::put('/job/{job}/update' , [JobController::class , 'update']);
Route::delete('/job/{job}/delete' , [JobController::class , 'delete']);

Route::post('/admin/store' , [AdminController::class , 'store']);
Route::get('/admin/{admin}/show' , [AdminController::class , 'show']);
Route::put('/admin/{admin}/update' , [AdminController::class , 'update']);
Route::delete('/admin/{admin}/delete' , [AdminController::class , 'delete']);

Route::get('/category', [CategoryController::class, 'index']);

Route::post('/category/store' , [CategoryController::class , 'store']);
Route::get('/category/{category}/show' , [CategoryController::class , 'show']);
Route::put('/category/{category}/update' , [CategoryController::class , 'update']);
Route::delete('/category/{category}/delete' , [CategoryController::class , 'delete']);

Route::post('/company/store' , [\App\Http\Controllers\CompanyController::class , 'store']);
Route::get('/company/{company}/show' , [\App\Http\Controllers\CompanyController::class , 'show']);
Route::put('/company/{company}/update' , [\App\Http\Controllers\CompanyController::class , 'update']);
Route::delete('/company/{company}/delete' , [\App\Http\Controllers\CompanyController::class , 'delete']);


Route::get('/user/{user}/token' , [\App\Http\Controllers\UserController::class , 'createToken']);

Route::middleware('auth:sanctum')->group(function (){
   Route::put('user/{user}/update' , [\App\Http\Controllers\UserController::class , 'update']);

});

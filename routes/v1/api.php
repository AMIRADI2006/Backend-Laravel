<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
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

Route::post('/job/store' , [JobController::class , 'store']);
Route::get('/job/{job}/show' , [JobController::class , 'show']);
Route::put('/job/{job}/update' , [JobController::class , 'update']);
Route::delete('/job/{job}/delete' , [JobController::class , 'delete']);

Route::post('/admin/store' , [AdminController::class , 'store']);
Route::get('/admin/{admin}/show' , [AdminController::class , 'show']);
Route::put('/admin/{admin}/update' , [AdminController::class , 'update']);
Route::delete('/admin/{admin}/delete' , [AdminController::class , 'delete']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

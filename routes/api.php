<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[\App\Http\Controllers\api\v1\UserController::class,'register']);
Route::post('login',[\App\Http\Controllers\api\v1\UserController::class,'login']);
Route::middleware('auth:sanctum')->group(function (){
    Route::get('product',[\App\Http\Controllers\api\v1\ProductController::class,'allproduct']);
    Route::get('product/{id}',[\App\Http\Controllers\api\v1\ProductController::class,'single']);
});

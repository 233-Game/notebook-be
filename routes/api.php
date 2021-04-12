<?php

use App\Http\Controllers\Api\Auth\AuthorizesController;
use App\Http\Controllers\Api\Base\PhoneCodeController;
use App\Http\Controllers\Api\Base\UploadController;
use App\Http\Controllers\Api\User\InfoController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
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

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::post('phone_code', [PhoneCodeController::class,'code']);

// 多认证途径
Route::post('authorizes', [AuthorizesController::class, 'authorizes']);

Route::middleware('auth:api')->group(function () {
    Route::get('user/info', [InfoController::class, 'show']);
    Route::post('user/config', [InfoController::class, 'saveConfig']);
    //通用接口
    Route::post('upload', [UploadController::class, 'upload']);
});

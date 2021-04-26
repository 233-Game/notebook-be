<?php

use App\Http\Controllers\Base\PhoneCodeController;
use App\Http\Controllers\Auth\AuthorizesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Base\UploadController;
use App\Http\Controllers\User\InfoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('login', [LoginController::class, 'login']);
Route::post('loginByPhoneCode', [LoginController::class, 'loginByPhoneCode']);

Route::post('register', [RegisterController::class, 'register']);


Route::post('authorizes', [AuthorizesController::class, 'auth']);
Route::post('authorizes/{type}/callback', [PhoneCodeController::class, 'callback']);

// Base
Route::post('phoneCode', [PhoneCodeController::class, 'code']);

Route::middleware(['auth:api',''])->group(function () {
    Route::get('user/info', [InfoController::class, 'show']);
    Route::post('user/config', [InfoController::class, 'saveConfig']);
    //通用接口
    Route::post('upload', UploadController::class);
});



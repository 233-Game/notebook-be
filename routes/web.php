<?php

use App\Http\Controllers\Api\Note\ContentController;
use App\Http\Controllers\Api\Note\NoteBookController;
use App\Http\Controllers\Api\Note\NoteTreeController;
use App\Http\Controllers\Base\PhoneCodeController;
use App\Http\Controllers\Auth\AuthorizesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Base\UploadController;
use App\Http\Controllers\Tag\TagController;
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

Route::get('authorizes', [AuthorizesController::class, 'redirectToProvider']);
Route::get('authorizes/{type}/callback', [AuthorizesController::class, 'handleCallback']);

// Base
Route::post('phoneCode', [PhoneCodeController::class, 'code']);

// 钩子

Route::middleware(['auth:api'])->group(function () {
    Route::get('user/info', [InfoController::class, 'show']);
    Route::post('user/config', [InfoController::class, 'saveConfig']);

    // 基础笔记
    Route::post('source/create', [ContentController::class,'create']);
    Route::put('source/{id}',[ContentController::class,'update']);
    Route::delete('source/{id}',[ContentController::class,'delete']);
    Route::get('source/{id}',[ContentController::class,'show']);
    Route::post('source/tags',[ContentController::class,'tag']);

    // 文件树
    Route::get('noteTree/list',[NoteTreeController::class,'getList']);
    Route::post('noteTree/create',[NoteTreeController::class,'create']);
    Route::put('noteTree/{id}',[NoteTreeController::class,'update']);
    Route::delete('noteTree/{id}',[NoteTreeController::class,'delete']);

    // 笔记本
    Route::get('noteBook/list',[NoteBookController::class,'getList']);
    Route::post('noteBook/create',[NoteBookController::class,'create']);
    Route::put('noteBook/{id}',[NoteBookController::class,'update']);
    Route::delete('noteBook/{id}',[NoteBookController::class,'delete']);

    // 标签
    Route::post('tag/create',[TagController::class,'create']);
    Route::put('tag/{id}',[TagController::class,'update']);
    Route::delete('tag/{id}',[TagController::class,'delete']);
    Route::get('tag/{id}',[TagController::class,'show']);

    // 外部数据源
    Route::post('remote/create');
    Route::delete('remote/{id}');
    Route::get('remote/{id}');

    // 工具
    Route::post('tools/export');
    Route::post('tools/git');
    Route::post('tools/transform');

    //通用接口
    Route::post('upload', UploadController::class);
});



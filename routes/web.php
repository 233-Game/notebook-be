<?php

use App\Http\Controllers\Note\ContentController;
use App\Http\Controllers\Note\NoteBookController;
use App\Http\Controllers\Note\NoteTreeController;
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

Route::get('isLogin', [LoginController::class, 'isLogin']);
Route::post('login', [LoginController::class, 'login']);
Route::post('loginByPhoneCode', [LoginController::class, 'loginByPhoneCode']);

Route::post('register', [RegisterController::class, 'register']);

Route::get('authorizes', [AuthorizesController::class, 'redirectToProvider']);
Route::get('authorizes/{type}/callback', [AuthorizesController::class, 'handleCallback']);

// Base
Route::post('phoneCode', [PhoneCodeController::class, 'code']);

// 钩子

Route::middleware(['jwt.auth'])->group(function () {
    // 用户模块
    Route::get('user/info', [InfoController::class, 'show']);
    Route::post('user/info', [InfoController::class, 'update']);
    Route::post('user/config', [InfoController::class, 'saveConfig']);

    // 基础笔记
    Route::get('source/list', [ContentController::class, 'getList']);
    Route::get('source/{source}', [ContentController::class, 'show'])->whereNumber('source');
    Route::post('source/create', [ContentController::class, 'create']);
    Route::post('source/tags', [ContentController::class, 'tag']);
    Route::put('source/{source}', [ContentController::class, 'show'])->whereNumber('source');
    Route::put('source/{source}', [ContentController::class, 'update'])->whereNumber('source');
    Route::delete('source/{source}', [ContentController::class, 'delete'])->whereNumber('source');

    // 文件树
    Route::get('noteTree/list', [NoteTreeController::class, 'getList']);
    Route::post('noteTree/create', [NoteTreeController::class, 'create']);
    Route::put('noteTree/{tree}', [NoteTreeController::class, 'update'])->whereNumber('tree');
    Route::delete('noteTree/{tree}', [NoteTreeController::class, 'delete'])->whereNumber('tree');
    Route::get('noteTree/{tree}', [NoteTreeController::class, 'show'])->whereNumber('tree');

    // 笔记本
    Route::get('noteBook/list', [NoteBookController::class, 'getList']);
    Route::post('noteBook/create', [NoteBookController::class, 'create']);
    Route::post('noteBook/createSource', [NoteBookController::class, 'createSource']);
    Route::put('noteBook/{noteBook}', [NoteBookController::class, 'update'])->whereNumber('noteBook');
    Route::delete('noteBook/{noteBook}', [NoteBookController::class, 'delete'])->whereNumber('noteBook');
    Route::get('noteBook/{noteBook}', [NoteBookController::class, 'show'])->whereNumber('noteBook');

    // 标签
    Route::post('tag/create', [TagController::class, 'create']);
    Route::put('tag/{id}', [TagController::class, 'update'])->whereNumber('id');
    Route::delete('tag/{id}', [TagController::class, 'delete'])->whereNumber('id');
    Route::get('tag/{id}', [TagController::class, 'show'])->whereNumber('id');
    Route::post('tag/bind', [TagController::class, 'bind']);


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



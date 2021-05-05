<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageUploadController;
use App\Http\Controllers\API\AccessLevelController;

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

Route::post('/login', \App\Http\Controllers\API\AuthController::class);
Route::post('/login/repair-password', [\App\Http\Controllers\API\ResetPasswordController::class, 'sendCode']);
Route::post('/login/repair-password/code', [\App\Http\Controllers\API\ResetPasswordController::class, 'resetPasswordCode']);
Route::post('/login/resend-code', [\App\Http\Controllers\API\ResetPasswordController::class, 'resendPasswordCode']);
Route::post('/login/repair-password/new-password', [\App\Http\Controllers\API\ResetPasswordController::class, 'resetPassword']);


Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
Route::post('/user/create', [UserController::class, 'store'])->name('userCreate');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
Route::post('/user/permission/create', [AccessLevelController::class, 'store'])->name('userPermission');
Route::get('/user/permission', [AccessLevelController::class, 'show'])->name('userPermissionShow');
Route::get('/user/permission/update', [AccessLevelController::class, 'update'])->name('userPermissionUpdate');

Route::post('/image/upload/avatar', [ImageUploadController::class, 'upload_avatar'])->name('userAvatar');



<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\UserSettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\ProfileController;
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


Route::post('/login', [AuthController::class, 'baseAuth']);
Route::post('/login/check-reserved-email', [AuthController::class, 'checkReservedEmail']);
Route::post('/login/check-secret', [AuthController::class, 'checkSecret']);
Route::post('/login/get-code', [AuthController::class, 'createAuthCode']);
Route::post('/login/reserved-password', [AuthController::class, 'loginWithPassword']);
Route::post('/login/login-code', [AuthController::class, 'loginWithCode']);
Route::post('/login/resend-code', [AuthController::class, 'loginWithCode']);
Route::post('/login/repair-password', [ResetPasswordController::class, 'sendCode']);
Route::post('/login/repair-password/code', [ResetPasswordController::class, 'resetPasswordCode']);
Route::post('/login/repair-password/code-word/new-password', [ResetPasswordController::class, 'resetPasswordSecretCode']);
Route::post('/login/resend-code', [ResetPasswordController::class, 'resendPasswordCode']);
Route::post('/login/repair-password/new-password', [ResetPasswordController::class, 'resetPassword']);

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{id}', [UserController::class, 'in_department'])->name('usersInDepartment');
Route::post('/users/delete', [UserController::class, 'destroy'])->name('usersDelete');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
Route::post('/user/create', [UserController::class, 'store'])->name('userCreate');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
Route::post('/user/permission/create', [AccessLevelController::class, 'store'])->name('userPermission');
Route::get('/user/permission', [AccessLevelController::class, 'show'])->name('userPermissionShow');
Route::get('/user/permission/update', [AccessLevelController::class, 'update'])->name('userPermissionUpdate');
Route::post('/image/upload/avatar', [ImageUploadController::class, 'upload_avatar'])->name('userAvatar');
Route::post('/user/settings/create',[SettingController::class,'store'])->name('setUserSetting');

Route::middleware('auth:api')->group(function () {
    Route::post('settings', [UserSettingsController::class, 'update']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/profile', [ProfileController::class, 'profile']);
});


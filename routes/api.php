<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\UserSettingsController;
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

Route::post('/login', [AuthController::class, 'baseAuth']);
Route::post('/login/get-code', [AuthController::class, 'createAuthCode']);
Route::post('/login/login-code', [AuthController::class, 'loginWithCode']);
Route::post('/login/resend-code', [AuthController::class, 'loginWithCode']);
Route::post('/login/repair-password', [ResetPasswordController::class, 'sendCode']);
Route::post('/login/repair-password/code', [ResetPasswordController::class, 'resetPasswordCode']);
Route::post('/login/resend-code', [ResetPasswordController::class, 'resendPasswordCode']);
Route::post('/login/repair-password/new-password', [ResetPasswordController::class, 'resetPassword']);

Route::middleware('auth:api')->group(function () {
    Route::post('settings', [UserSettingsController::class, 'update']);
});

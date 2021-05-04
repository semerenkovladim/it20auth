<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SendUserController;

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
Route::get('/user', [UserController::class, 'show'])->name('user');
Route::post('/user/create', [UserController::class, 'store'])->name('userCreate');
Route::patch('/user/update', [UserController::class, 'update'])->name('userUpdate');

Route::post('/send/user-password', [SendUserController::class, 'send'])->name('sendUserPassword');

<?php

use App\Http\Controllers\ActivateUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RefreshTokenController;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterNewUserController::class);
    Route::post('email/verify', VerifyEmailController::class);
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth');
    Route::post('refresh', RefreshTokenController::class)->middleware('auth');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('users', [UsersController::class, 'index']);
    Route::put('users/{id}/activate', ActivateUserController::class);
});

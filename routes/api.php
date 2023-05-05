<?php

use App\Http\Controllers\ActivateUserController;
use App\Http\Controllers\Admin\ApproveShipController;
use App\Http\Controllers\Admin\RejectShipController;
use App\Http\Controllers\Admin\ShipController as AdminShipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RefreshTokenController;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\UpdateProfileController;
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

    Route::get('ships', [AdminShipController::class, 'index']);
    Route::get('ships/{id}', [AdminShipController::class, 'show']);
    Route::post('ships/{id}/approve', ApproveShipController::class);
    Route::post('ships/{id}/reject', RejectShipController::class);
});

Route::get('ships', [ShipController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('ships', [ShipController::class, 'store']);
    Route::put('ships/{id}', [ShipController::class, 'update']);

    Route::put('profile', UpdateProfileController::class);
});

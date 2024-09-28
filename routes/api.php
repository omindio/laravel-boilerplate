<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SpaAuthController;


Route::middleware(['throttle:api'])->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });

    Route::middleware(['web'])->group(function () {
        Route::post('/auth/spa/login', [SpaAuthController::class, 'login']);
    });

    Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle.forgot.password');
    Route::post('/auth/reset-password', [ForgotPasswordController::class, 'resetPassword']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/spa/logout', [SpaAuthController::class, 'logout']);
        Route::get('/auth/user', [AuthController::class, 'user']);
    });
});

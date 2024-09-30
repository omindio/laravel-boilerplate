<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Auth\Controllers\AuthController;
use App\Domains\Auth\Controllers\ForgotPasswordController;
use App\Domains\Auth\Controllers\SpaAuthController;

Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::middleware(['web'])->group(function () {
            Route::post('/spa/login', [SpaAuthController::class, 'login']);
        });

        Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle.forgot.password');
        Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/spa/logout', [SpaAuthController::class, 'logout']);
            Route::get('/user', [AuthController::class, 'user']);
        });
    }
);

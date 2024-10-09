<?php

use Illuminate\Support\Facades\Route;
use App\BoundedContext\Auth\Http\Controllers\AuthController;
use App\BoundedContext\Auth\Http\Controllers\ForgotPasswordController;
use App\BoundedContext\Auth\Http\Controllers\SpaAuthController;

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

<?php

use Illuminate\Support\Facades\Route;
//use App\BoundedContext\Auth\Http\Controllers\ForgotPasswordController;
use App\BoundedContext\Authentication\Presentation\Controller\SessionAuthenticationController;
use App\BoundedContext\Authentication\Presentation\Controller\AuthenticationController;

Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::middleware(['web'])->group(function () {
            Route::post('/session/login', [SessionAuthenticationController::class, 'login']);
        });

        //Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle.forgot.password');
        //Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/session/logout', [SessionAuthenticationController::class, 'logout']);
            Route::get('/user', [AuthenticationController::class, 'user']);
        });
    }
);

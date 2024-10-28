<?php

use Illuminate\Support\Facades\Route;
use App\BoundedContext\Authentication\Presentation\Controller\PasswordResetController;
use App\BoundedContext\Authentication\Presentation\Controller\SessionAuthenticationController;
use App\BoundedContext\Authentication\Presentation\Controller\AuthenticationController;

Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::middleware(['web'])->group(function () {
            Route::post('/session/login', [SessionAuthenticationController::class, 'login']);

            Route::middleware('auth:sanctum')->group(function () {
                Route::post('/session/logout', [SessionAuthenticationController::class, 'logout']);
                Route::get('/user', [AuthenticationController::class, 'user']);
            });
        });

        Route::post('/password/request', [PasswordResetController::class, 'requestPasswordReset'])->middleware('throttle.forgot.password');
        Route::post('/password/reset', [PasswordResetController::class, 'passwordReset']);
    }
);

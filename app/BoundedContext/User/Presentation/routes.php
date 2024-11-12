<?php

use App\BoundedContext\User\Presentation\Controller\UserPasswordController;
use App\BoundedContext\User\Presentation\Controller\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'users'],
    function () {
        Route::middleware(['web'])->group(function () {
            Route::middleware(['auth:sanctum'])->group(function () {
                Route::put('/password', [UserPasswordController::class, 'update']);
                Route::put('/profile', [UserProfileController::class, 'update']);
                Route::get('/profile', [UserProfileController::class, 'getProfile']);
            });
        });
    }
);

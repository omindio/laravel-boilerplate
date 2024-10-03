<?php

use App\Domains\Users\Controllers\UpdatePasswordController;
use App\Domains\Users\Controllers\UpdateProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'users'],
    function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::put('/password', [UpdatePasswordController::class, 'update']);
            Route::put('/profile', [UpdateProfileController::class, 'update']);
            Route::get('/profile', [UpdateProfileController::class, 'show']);
        });
    }
);

<?php

use App\Domains\Users\Controllers\UpdatePasswordController;
use App\Domains\Users\Controllers\UpdateProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'users'],
    function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::put('/password', [UpdateProfileController::class, 'update']);
            Route::put('/profile', [UpdatePasswordController::class, 'update']);
        });
    }
);

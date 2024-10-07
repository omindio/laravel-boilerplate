<?php

use App\Domain\Users\Http\Controllers\PasswordController;
use App\Domain\Users\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'users'],
    function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::put('/password', [PasswordController::class, 'update']);
            Route::put('/profile', [ProfileController::class, 'update']);
            Route::get('/profile', [ProfileController::class, 'show']);
        });
    }
);

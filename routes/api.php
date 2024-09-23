<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['throttle:api'])->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });

    Route::middleware(['web'])->group(function () {
        Route::post('/auth/spa-login', [AuthController::class, 'spaLogin']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/spa-logout', [AuthController::class, 'spaLogout']);
        Route::get('/auth/user', [AuthController::class, 'user']);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use L5Swagger\Http\Controllers\SwaggerController;

Route::middleware(['throttle:api'])->group(function () {
    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });
});

<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {

    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });

    $domainDirectories = glob(base_path('app/Domains/*/Routes/*.php'));

    foreach ($domainDirectories as $routeFile) {
        require $routeFile;
    }
});

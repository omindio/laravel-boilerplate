<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {

    Route::get('/health', function () {
        return response()->json(['status' => 'ok']);
    });

    $boundedContextDirectories = glob(base_path('app/BoundedContext/*/Presentation/routes.php'));

    foreach ($boundedContextDirectories as $routeFile) {
        require $routeFile;
    }
});

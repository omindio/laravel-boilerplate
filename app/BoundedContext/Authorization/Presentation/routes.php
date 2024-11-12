<?php

use App\BoundedContext\Authorization\Presentation\Controller\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'authorization'],
    function () {
        Route::middleware(['web'])->group(function () {
            Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
                Route::post('/roles', [RoleController::class, 'create']);
                Route::post('/roles/{id}', [RoleController::class, 'update']);
                Route::delete('/roles', [RoleController::class, 'delete']);
                Route::get('/roles', [RoleController::class, 'getAll']);
            });
        });
    }
);

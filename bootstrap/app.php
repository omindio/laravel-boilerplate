<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use App\BoundedContext\Authentication\Infrastructure\Middleware\ThrottleForgotPasswordRequests;
//use App\Domains\Auth\Http\Middlewares\CustomBasicAuthMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../app/Shared/Presentation/Routes.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        $middleware->alias([
            'throttle.forgot.password' => ThrottleForgotPasswordRequests::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        ]);
        //$middleware->alias(['custom.auth.basic' => CustomBasicAuthMiddleware::class]);
    })
    ->withExceptions()->create();

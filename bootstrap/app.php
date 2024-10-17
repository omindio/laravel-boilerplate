<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
//use App\Domain\Auth\Http\Middlewares\ThrottleForgotPasswordRequests;
//use App\Domains\Auth\Http\Middlewares\CustomBasicAuthMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../app/Shared/Presentation/Routes.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        //$middleware->alias(['custom.auth.basic' => CustomBasicAuthMiddleware::class]);
        //$middleware->alias(['throttle.forgot.password' => ThrottleForgotPasswordRequests::class]);
    })
    ->withExceptions()->create();

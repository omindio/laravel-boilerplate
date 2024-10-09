<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use App\Domain\Auth\Http\Middlewares\ThrottleForgotPasswordRequests;
//use App\Domains\Auth\Http\Middlewares\CustomBasicAuthMiddleware;

//TODO: Revisar añadir un error 500 si no hay condicion de excepcion
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../src/Presentation/Routes/api.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        //$middleware->alias(['custom.auth.basic' => CustomBasicAuthMiddleware::class]);
        $middleware->alias(['throttle.forgot.password' => ThrottleForgotPasswordRequests::class]);
    })
    ->withExceptions([App\Shared\Exception\GlobalExceptionHandler::class, 'handle'])->create();

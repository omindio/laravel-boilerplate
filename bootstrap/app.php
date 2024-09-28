<?php

use App\Http\Responses\ApiErrorResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        $middleware->alias(['custom.auth.basic' => \App\Http\Middleware\CustomBasicAuthMiddleware::class]);
        $middleware->alias(['throttle.forgot.password' => \App\Http\Middleware\ThrottleForgotPasswordRequests::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //TODO: Revisar en pruebas reales si estas excepciones son las correctas y devuelven los mensajes correctos
        $exceptions->render(function (Throwable $e) {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return ApiErrorResponse::send($e->getMessage(), ['HTTP Exception'], $e->getStatusCode());
            }

            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return ApiErrorResponse::send('Unauthenticated: Please log in to access this resource.', ['Unauthenticated'], 401);
            }

            if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return ApiErrorResponse::send('Forbidden: You do not have access to this resource.', ['Forbidden'], 403);
            }
        });
    })->create();

<?php

use App\Shared\Http\Responses\ApiErrorResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Domains\Auth\Middlewares\CustomBasicAuthMiddleware;
use App\Domains\Auth\Middlewares\ThrottleForgotPasswordRequests;

//TODO: Revisar añadir un error 500 si no hay condicion de excepcion
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        $middleware->alias(['custom.auth.basic' => CustomBasicAuthMiddleware::class]);
        $middleware->alias(['throttle.forgot.password' => ThrottleForgotPasswordRequests::class]);
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

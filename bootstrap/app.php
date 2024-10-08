<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
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
    ->withExceptions(function (Exceptions $exceptions) {})->create();

    /*

$exceptions->render(function (Throwable $e) {
    if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
        return ApiErrorResponse::send($e->getMessage(), ['HTTP Exception'], $e->getStatusCode());
    }

    if ($e instanceof \Illuminate\Auth\AuthenticationException) {
        return ApiErrorResponse::send('No autenticado: Inicia sesión para acceder a la app.', ['Unauthenticated'], 401);
    }

    if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
        return ApiErrorResponse::send('Prohibido: No tienes permisos para acceder.', ['Forbidden'], 403);
    }
});
    */

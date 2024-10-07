<?php

use App\Infrastructure\Http\Responses\ApiErrorResponse;

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

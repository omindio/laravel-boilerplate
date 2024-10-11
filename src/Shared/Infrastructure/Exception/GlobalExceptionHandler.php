<?php

namespace App\Shared\Infrastructure\Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class GlobalExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Ejemplo: manejo de excepciones de dominio relacionadas con la autenticación
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'Unauthenticated. Please login to access this resource.'
            ], 401);
        }

        // Ejemplo: manejo de excepciones de permisos (autorización)
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'error' => 'Unauthorized. You do not have the required permissions.'
            ], 403);
        }

        // Manejo de excepciones relacionadas con recursos no encontrados
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'Resource not found.'
            ], 404);
        }

        // Manejo por defecto de todas las demás excepciones
        return parent::render($request, $exception);
    }
}

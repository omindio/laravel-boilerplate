<?php

namespace App\Shared\Infrastructure\Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;

use Throwable;

class GlobalExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado. Inicia sesión para acceder.'
            ], 401);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado. No tienes los permisos necesarios.'
            ], 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Recurso no encontrado.'
            ], 404);
        }

        if ($exception instanceof TokenMismatchException) {
            return response()->json([
                'success' => false,
                'message' => 'Actualiza la página y inténtalo de nuevo. El token CSRF no coincide.'
            ], 419);
        }

        // Manejo por defecto de todas las demás excepciones
        return parent::render($request, $exception);
    }
}

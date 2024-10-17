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
                'message' => 'Unauthenticated. Please login to access this resource.'
            ], 401);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You do not have the required permissions.'
            ], 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.'
            ], 404);
        }

        if ($exception instanceof TokenMismatchException) {
            return response()->json([
                'success' => false,
                'message' => 'CSRF token mismatch. Please refresh the page and try again.'
            ], 419);
        }

        // Manejo por defecto de todas las demás excepciones
        return parent::render($request, $exception);
    }
}

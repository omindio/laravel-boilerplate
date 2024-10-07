<?php

namespace App\Infrastructure\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiErrorResponse
{
    public static function send($message = 'An error occurred', $errors = [], $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}

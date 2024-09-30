<?php

namespace App\Shared\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiSuccessResponse
{
    public static function send($data = [], $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'timestamp' => now()->toISOString(),
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function error($message, $statusCode = 400, $errors = [])
    {
        return response()->json([
            'timestamp' => now()->toISOString(),
            'status' => $statusCode,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
    
}

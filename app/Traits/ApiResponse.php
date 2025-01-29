<?php

namespace App\Traits;


use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    public static function successResponse($data = true, $code = 200)
    {
        return Response::json([
            'status' => true,
            'data' => $data
        ]);
    }

    public static function errorResponse($message, $code = 200)
    {
        return Response::json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}

<?php

namespace App\Trait;

trait ResponseTrait
{
    public function successResponse($data=null, $message = true, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
    public function successResponseWithMessage($message, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ], $code);
    }
}

<?php
namespace App\Traits;

trait ResponseMessageTraits
{
    public function successResponse($message, $data = null, $meta = null)
    {
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => $message,
            'title' => 'Success!',
            'type' => 'success',
            'data' => $data,
            'meta' => $meta
        ]);

    }

    public function errorResponse($message, $data = null, $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'status' => $statusCode,
            'message' => $message,
            'title' => 'Error!',
            'type' => 'error',
            'data' => $data
        ]);
    }
    public function warningResponse($message, $data = null)
    {
        return response()->json([
            'status' => 199,
            'message' => $message,
            'title' => 'Warning!',
            'type' => 'warning',
            'data' => $data
        ]);
    }

    public function validationErrorResponse($message, $data = null)
    {
        return response()->json([
            'status' => 403,
            'message' => $message,
            'title' => 'Validation failed!',
            'type' => 'error',
            'data' => $data
        ],403);
    }
}
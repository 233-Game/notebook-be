<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected function failed($message, $code = 1): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }

    protected function success($data, $code = 0): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => 'success',
            'data' => $data
        ]);
    }
}

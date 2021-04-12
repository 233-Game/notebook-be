<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected function failed($message, $code = 1, $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function success($data = true, $code = 0): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function errors($data)
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'data' => $data
        ]);
    }
}

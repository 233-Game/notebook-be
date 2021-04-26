<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

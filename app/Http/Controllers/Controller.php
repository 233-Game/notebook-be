<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function format($res)
    {
        if ($res) {
            return $this->success();
        }
        return $this->failed('');
    }

    protected function formatDelete($res): \Illuminate\Http\JsonResponse
    {
        if ($res) {
            return $this->success();
        }
        return $this->failed('');
    }

    protected function formatApplication($res): \Illuminate\Http\JsonResponse
    {
        return $this->success();
    }

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

    protected function loginToken($token, $rememberToken = ''): \Illuminate\Http\JsonResponse
    {
        $data = [
            'user' => auth('api')->user(),
            'token' => $token,
            'expired_at'=> auth('api')->factory()->getTTL() * 60
        ];
        if (!empty($rememberToken)) {
            $data['remember_token'] = $rememberToken;
        }
        return $this->success($data);
    }

    protected function errors($data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'data' => $data
        ])->setStatusCode(422);
    }
}

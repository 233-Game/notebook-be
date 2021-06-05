<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
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
            if ($res instanceof Model)
                return $this->success($res->id);
            return $this->success();
        }
        return $this->failed('');
    }

    public function json($data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
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
        if (is_bool($res) && !$res) {
            return $this->failed('error');
        }
        if ($res instanceof Model) {
            $res = $res->id;
        }
        return $this->success($res);
    }

    protected function failed($message, $code = 1, $data = []): \Illuminate\Http\JsonResponse
    {
        return $this->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function success($data = true, $message = 'success', $code = 0): \Illuminate\Http\JsonResponse
    {
        return $this->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function loginToken($token, $rememberToken = ''): \Illuminate\Http\JsonResponse
    {
        $data = [
            'user' => auth('api')->user(),
            'token' => $token,
            'expired_at' => auth('api')->factory()->getTTL() * 60
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

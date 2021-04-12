<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $this->credentials($request);
        if (!empty($credentials) && $token = auth('api')->attempt($credentials)) {
            return $this->success([
                'user' => auth()->user(),
                'token' => $token
            ]);
        }
        return $this->failed('用户名或密码错误');
    }

    private function credentials(Request $request): array
    {
        // 根据登录方式返回不同的值
        return $request->input(['phone', 'password']) ?? [];
    }
}

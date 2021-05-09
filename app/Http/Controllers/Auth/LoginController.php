<?php


namespace App\Http\Controllers\Auth;


use App\Enums\PhoneCode\SendTypes;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\PhoneCodeVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function isLogin(): \Illuminate\Http\JsonResponse
    {
        return $this->success(!auth('api')->guest());
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $remember = $request->input('remember_me', false);
        // remember password
        if ($token = $this->attempt($request)) {
            $remember = $remember ? Str::random(26) : '';

            auth('api')->user()->update([
                'remember_token' => $remember
            ]);

            return $this->loginToken($token, $remember);
        }
        return $this->failed('用户名或密码错误');
    }

    public function loginByPhoneCode(Request $request, PhoneCodeVerify $codeVerify): \Illuminate\Http\JsonResponse
    {
        $phone = $request->get('phone');
        $code = $request->get('code');
        // 校验代码
        if (!$codeVerify->verify($phone, $code, SendTypes::LOGIN)) {
            $this->failed('验证码错误');
        }

        $user = User::where('phone', $phone)->first();

        if (!$user) {
            $this->failed('登录失败，清联系管理员');
        }

        return $this->loginToken(auth('api')->login($user));
    }

    private function attempt(Request $request)
    {
        $phone = $request->get('phone');
        if ($rememberToken = $request->get('remember_token')) {
            $user = User::where('phone', $phone)->where('remember_token', $rememberToken)->first();
            $rememberToken = auth('api')->login($user);
        } else {
            $password = $request->get('password');
            $rememberToken = auth('api')->attempt(compact('phone', 'password'));
        }
        return $rememberToken;
    }
}

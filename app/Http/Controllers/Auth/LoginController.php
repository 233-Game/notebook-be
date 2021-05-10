<?php


namespace App\Http\Controllers\Auth;


use App\Enums\PhoneCode\SendTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Utils\PhoneCodeVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function isLogin(): \Illuminate\Http\JsonResponse
    {
        return $this->success(!auth('api')->guest());
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
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
        return $this->failed('用户名或密码错误')->setStatusCode(422);
    }

    public function loginByPhoneCode(LoginRequest $request, PhoneCodeVerify $codeVerify): \Illuminate\Http\JsonResponse
    {
        $phone = $request->get('phone');
        $code = $request->get('code');
        // 校验代码
        if (!$codeVerify->verify($phone, $code, SendTypes::LOGIN)) {
            return $this->errors(['code' => '验证码错误']);
        }

        $user = User::where('phone', $phone)->first();

        if (!$user) {
            $user = User::create([
                'phone' => $phone,
                'name' => $phone
            ]);
        }

        return $this->loginToken(auth('api')->login($user));
    }

    private function attempt(Request $request)
    {
        $phone = $request->get('phone');
        $password = $request->get('password');
        if (strlen($password) >= 20) {
            $user = User::where('phone', $phone)->where('remember_token', $password)->first();
            $rememberToken = auth('api')->login($user);
        } else {
            $rememberToken = auth('api')->attempt(compact('phone', 'password'));
        }
        return $rememberToken;
    }
}

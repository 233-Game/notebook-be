<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Utils\PhoneCodeVerify;
use Illuminate\Support\Str;

class RegisterController extends ApiController
{
    public function register(RegisterRequest $request, PhoneCodeVerify $codeVerify): \Illuminate\Http\JsonResponse
    {
        $phone = $request->get('phone');
        $password = $request->get('password');
        $code = $request->get('code');

        if (!$codeVerify->verify($phone, $code)) {
            return $this->errors(['code'=>['验证码错误或失效']]);
        }

        $user = User::create([
            'name' => Str::random(10) . '_' . $phone,
            'phone' => $phone,
            'password' => bcrypt($password)
        ]);
        return $this->success(true);
    }
}

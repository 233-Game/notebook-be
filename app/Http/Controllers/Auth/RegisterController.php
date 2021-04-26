<?php


namespace App\Http\Controllers\Auth;


use App\Enums\PhoneCode\SendTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Utils\PhoneCodeVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request, PhoneCodeVerify $codeVerify): \Illuminate\Http\JsonResponse
    {
        $phone = $request->get('phone');
        $password = $request->get('password');
        $code = $request->get('code');

        if (!$codeVerify->verify($phone, $code, SendTypes::REGISTER)) {
            return $this->errors(['code' => ['验证码错误或失效']]);
        }

        $user = User::create([
            'name' => Str::random(10) . '_' . $phone,
            'phone' => $phone,
            'password' => Hash::make($password)
        ]);

        return $this->success(true);
    }
}

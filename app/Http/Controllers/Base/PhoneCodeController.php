<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneCodeRequest;
use App\Utils\PhoneCodeVerify;
use Illuminate\Support\Facades\Auth;
use Overtrue\EasySms\EasySms;

class PhoneCodeController extends Controller
{
    const GUEST_TYPE = ['login', 'register'];

    public function code(PhoneCodeVerify $codeVerify, PhoneCodeRequest $request): \Illuminate\Http\JsonResponse
    {
        // exist all type
        $type = $request->get('type');
        // 校验手机号
        $phone = $request->get('phone');

        if (!in_array($type, self::GUEST_TYPE) && empty(Auth::user())) {
            return $this->failed('error');
        }
        // 判断是否具有缓存
        if (!$codeVerify->verifyTTl($phone, $type)) {
            return $this->failed('你请求的过于频繁');
        }

        /** @var EasySms $easySms */
        try {
            if (config('app.debug')) {
                $code = '123456';
            } else {
                $code = str_pad(random_int(1, 10), 6, 0, STR_PAD_LEFT);
                $easySms = app('easysms');
                $easySms->send($phone, [
                    'template' => 'SMS_174806102',
                    'data' => [
                        'code' => $code
                    ],
                ]);
            }
            $codeVerify->updateData($phone, $code, $type);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return $this->failed($message);
        }
        return $this->success();
    }


}

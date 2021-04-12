<?php


namespace App\Http\Controllers\Api\Base;


use App\Http\Controllers\Api\ApiController;
use App\Utils\PhoneCodeVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\InvalidArgumentException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class PhoneCodeController extends ApiController
{

    public function code(Request $request, PhoneCodeVerify $codeVerify): \Illuminate\Http\JsonResponse
    {
        // 校验手机号
        $phone = $request->get('phone');
        // 判断是否具有缓存

        if (!$codeVerify->verifyTTl($phone)) {
            return $this->failed('你请求的过于频繁');
        }

        /** @var EasySms $easySms */
        try {
            if (config('app.debug')) {
                $code = '123456';
            } else {
                $code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);
                $easySms = app('easysms');
                $easySms->send($phone, [
                    'template' => 'SMS_174806102',
                    'data' => [
                        'code' => $code
                    ],
                ]);
            }
            $codeVerify->updateData($phone, $code);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return $this->failed($message);
        }
        return $this->success();
    }


}

<?php


namespace App\Utils;


use Illuminate\Support\Facades\Cache;

class PhoneCodeVerify
{
    const SMS_TIME = 60 * 5;
    const KEY_PREFIX = 'phone_%s_code';

    public function updateData($phone, $code): bool
    {
        return Cache::put($this->getCacheKey($phone), [
            'forward_time' => time() + 60,
            'code' => $code
        ], self::SMS_TIME);
    }

    public function getDataByPhone($phone): array
    {
        return $this->getData($this->getCacheKey($phone));
    }

    public function verify($phone, $code): bool
    {
        $data = $this->getDataByPhone($phone);
        if (!empty($data) && $data['code'] === $code) {
            return true;
        }
        return false;
    }

    public function verifyTTl($phone): bool
    {
        /** @var array $data */
        $data = $this->getCacheKey($phone);
        return ($data['forward_time'] ?? 0) < time() ;
    }

    private function getData($key): array
    {
        return Cache::get($key) ?? [];
    }


    private function getCacheKey($phone): string
    {
        return sprintf(self::KEY_PREFIX, $phone);
    }
}

<?php


namespace App\Utils;


use Illuminate\Support\Facades\Cache;

class PhoneCodeVerify
{
    const SMS_TIME = 60 * 5;
    const KEY_PREFIX = 'phone_%s_code_%s';

    public function updateData($phone, $code, $type): bool
    {
        return Cache::put($this->getCacheKey($phone, $type), [
            'forward_time' => time() + 60,
            'code' => $code
        ], self::SMS_TIME);
    }

    public function getDataByPhone($phone, $type): array
    {
        return $this->getData($this->getCacheKey($phone, $type));
    }

    public function verify($phone, $code, $type): bool
    {
        $data = $this->getDataByPhone($phone, $type);
        if (!empty($data) && $data['code'] === $code) {
            return true;
        }
        return false;
    }

    public function verifyTTl($phone, $type): bool
    {
        $data = $this->getData($this->getCacheKey($phone, $type));
        return ($data['forward_time'] ?? 0) < time();
    }

    private function getData($key): array
    {
        return Cache::get($key) ?? [];
    }


    private function getCacheKey($phone, $type): string
    {
        return sprintf(self::KEY_PREFIX, $phone, $type);
    }
}

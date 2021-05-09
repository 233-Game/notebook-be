<?php


namespace App\Application\Authorizes;


use App\Models\User;
use Mockery\Exception;
use Overtrue\LaravelSocialite\Socialite;

class LoginByOtherAppsApplication
{
    private $type;
    private $code;

    public function setParameter($type, $code): LoginByOtherAppsApplication
    {
        $this->type = $type;
        $this->code = $code;
        return $this;
    }

    public function execute()
    {
        try {
            $userInfo = Socialite::create($this->type)->userFromCode($this->code);
        } catch (Exception $exception) {
            return null;
        }
        $credit = [];
        $data = [];
        switch ($this->type) {
            case 'github':
                $credit = ['github_id' => $userInfo->id];
                // 将图片下载下来
                $data = [
                    'name' => $userInfo->name,
                    'github_id' => $userInfo->id,
                    'github_name' => $userInfo->nickname,
                    'avatar' => $userInfo->avatar
                ];
                break;
            case 'weibo':
                break;
        }

        $user = User::where($credit)->first();
        if (empty($user)) {
            $user = User::create($data);
        }
        return $user;
    }

}

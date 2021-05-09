<?php


namespace App\Http\Controllers\Auth;

use App\Application\Authorizes\LoginByOtherAppsApplication;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Overtrue\LaravelSocialite\Socialite;

class AuthorizesController extends Controller
{

    public function handleCallback($type, Request $request, LoginByOtherAppsApplication $loginByOtherAppsApplication): \Illuminate\Http\JsonResponse
    {
        $user = $loginByOtherAppsApplication->setParameter($type, $request->query('code'))->execute();
        if (empty($user)) {
            return $this->failed('授权失败');
        }
        return $this->loginToken(auth('api')->login($user));
    }

    public function redirectToProvider(Request $request): \Illuminate\Http\RedirectResponse
    {
        switch ($request->get('type')) {
            case 'github':
                return redirect()->to(Socialite::create('github')->redirect());
        }
    }

}

<?php


namespace App\Http\Controllers\Auth;


use App\Enums\PhoneCode\SendTypes;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\PhoneCodeVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();
        return $this->success(true);
    }
}

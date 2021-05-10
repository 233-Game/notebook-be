<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserInfoResource;

class InfoController extends Controller
{
    public function show()
    {
        return $this->success(new UserInfoResource(auth('api')->user()));
    }

    public function update()
    {

    }

    public function config()
    {

    }

}

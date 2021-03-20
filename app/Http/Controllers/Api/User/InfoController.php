<?php


namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;

class InfoController extends ApiController
{
    public function show(): \Illuminate\Http\JsonResponse
    {
        return $this->success([
            'user' => Auth::user()
        ]);
    }

}

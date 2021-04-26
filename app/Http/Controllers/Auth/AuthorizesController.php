<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthorizesController extends Controller
{

    public function callback($type)
    {
        switch ($type) {
            case 'github':
                break;
        }
    }

    public function authorize($ability, $arguments = [])
    {

    }

}

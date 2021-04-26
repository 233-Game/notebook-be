<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'check_password' => 'required',
            'code' => ['integer','required']
        ];
    }
}

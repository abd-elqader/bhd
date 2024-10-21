<?php

namespace App\Http\Requests\Central\User;

class  LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|digits_between:6,12',
            'password' => 'required|min:6',
        ];
    }
}

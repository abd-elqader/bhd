<?php

namespace App\Http\Requests\Mix\User;

class  LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|digits_between:6,12',
            'password' => ['required', 'string'],
        ];
    }
}

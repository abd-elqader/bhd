<?php

namespace App\Http\Requests\Tenant\API;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => ['required'],
            'password' => ['required'],
            'device_token' => ['nullable'],
        ];
    }
}

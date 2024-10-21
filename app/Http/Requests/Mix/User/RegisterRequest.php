<?php

namespace App\Http\Requests\Mix\User;

class  RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string'],
            'phone_code' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}

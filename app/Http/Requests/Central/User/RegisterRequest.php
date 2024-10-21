<?php

namespace App\Http\Requests\Central\User;

class  RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
            'phone' => ['required', 'string', 'max:255', 'unique:clients,phone'],
            'country_code' => ['nullable', 'string'],
            'phone_code' => ['nullable', 'string'],
            'password' => 'required|min:6',
        ];
    }
}

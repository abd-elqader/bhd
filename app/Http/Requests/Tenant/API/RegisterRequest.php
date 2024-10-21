<?php

namespace App\Http\Requests\Tenant\API;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required','unique:clients,email'],
            'phone' => ['required','unique:clients,phone'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
            'country_code' => ['required', 'exists:countries,country_code'],
            'phone_code' => ['required'],
            'device_token' => ['nullable'],
        ];
    }
}

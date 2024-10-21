<?php

namespace App\Http\Requests\Tenant\API;

class UpdateProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable'],
            'email' => ['required_without:phone'],
            'phone' => ['required_without:email'],
            'password' => ['nullable'],
            'password_confirmation' => ['nullable', 'same:password'],
            'code' => ['nullable', 'exists:countries,code'],
            'phone_code' => ['nullable'],
            'device_token' => ['nullable'],
        ];
    }
}

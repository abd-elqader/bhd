<?php

namespace App\Http\Requests\Mix\Admin;

class  UpdateAdminRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'status' => ['sometimes', 'required', 'boolean'],
            'country_code' => ['required', 'string'],
            'phone_code' => ['required', 'string'],
            'image' => ['sometimes', 'required', 'image', 'max:2048'],
        ];
    }
}

<?php

namespace App\Http\Requests\Mix\Admin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'domain_name' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string'],
            'phone_code' => ['required', 'string'],
            'password' => ['nullable', 'string', 'confirmed', 'min:6'],
        ];
    }
}

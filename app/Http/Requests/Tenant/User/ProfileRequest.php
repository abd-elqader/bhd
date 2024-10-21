<?php

namespace App\Http\Requests\Tenant\User;

class  ProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required|between:3,20',
            'password' => 'nullable|min:6',
        ];
    }
}

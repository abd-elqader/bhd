<?php

namespace App\Http\Requests\Tenant\User;

class  RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => ['required','unique:clients,email'],
            'phone' => ['required','unique:clients,phone'],
            'name' => ['required'],
            'password' => ['required'],
        ];
    }
}

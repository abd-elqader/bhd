<?php

namespace App\Http\Requests\Central\User;

class  ProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:clients,email,'.auth('client')->user()->id,
            'firstName' => 'required|between:3,20',
            'lastName' => 'required|between:3,20',
            'password' => 'nullable|min:6',
        ];
    }
}

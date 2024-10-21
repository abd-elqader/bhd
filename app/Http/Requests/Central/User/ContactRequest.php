<?php

namespace App\Http\Requests\Central\User;

class  ContactRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|between:3,50',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'subject' => 'required|between:3,50',
            'message' => 'required|min:3',
        ];
    }
}

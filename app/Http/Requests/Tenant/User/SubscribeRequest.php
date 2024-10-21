<?php

namespace App\Http\Requests\Tenant\User;

class  SubscribeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|unique:subscribtion,email',
        ];
    }
}

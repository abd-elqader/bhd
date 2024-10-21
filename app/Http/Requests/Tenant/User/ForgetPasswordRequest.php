<?php

namespace App\Http\Requests\Tenant\User;

class  ForgetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|digits_between:8,12',
        ];
    }
}

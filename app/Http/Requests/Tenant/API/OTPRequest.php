<?php

namespace App\Http\Requests\Tenant\API;

class OTPRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|min:6',
            'phone_code' => 'required',
        ];
    }
}

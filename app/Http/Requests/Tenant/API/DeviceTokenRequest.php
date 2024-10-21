<?php

namespace App\Http\Requests\Tenant\API;

class DeviceTokenRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'device_token' => ['required'],
        ];
    }
}

<?php

namespace App\Http\Requests\Tenant\API;

class CheckNumberRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|min:6',
        ];
    }
}

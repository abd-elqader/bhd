<?php

namespace App\Http\Requests\Tenant\API;

class GetCartRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'branch_id' => ['nullable'],
            'lat' => ['nullable'],
            'long' => ['nullable'],
        ];
    }
}

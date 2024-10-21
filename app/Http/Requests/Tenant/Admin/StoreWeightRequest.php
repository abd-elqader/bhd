<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreWeightRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'weight' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
}

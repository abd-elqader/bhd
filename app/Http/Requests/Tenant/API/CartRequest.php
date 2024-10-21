<?php

namespace App\Http\Requests\Tenant\API;

class CartRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required'],
            'quantity' => ['required'],
            'size_id' => ['required'],
            'color_id' => ['nullable'],
            'note' => ['nullable'],
        ];
    }
}

<?php

namespace App\Http\Requests\Tenant\API;

class ProductFavouriteRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
        ];
    }
}

<?php

namespace App\Http\Resources\Tenant;

class ProductFavouriteResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'product' => ProductResource::make($this->Product),
        ];
    }
}

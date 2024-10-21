<?php

namespace App\Http\Resources\Tenant;

class ImageResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'image' => public_asset($this->image),
        ];
    }
}

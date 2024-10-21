<?php

namespace App\Http\Resources\Tenant;

class CategoryResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'image' => public_asset($this->image),
        ];
    }
}

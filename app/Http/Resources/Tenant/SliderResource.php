<?php

namespace App\Http\Resources\Tenant;

class SliderResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'desc' => strip_tags($this->desc()),
            'image' => public_asset($this->image),
        ];
    }
}

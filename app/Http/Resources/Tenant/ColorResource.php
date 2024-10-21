<?php

namespace App\Http\Resources\Tenant;

class ColorResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'hexa' => $this->hexa,
            'status' => $this->status,
        ];
    }
}

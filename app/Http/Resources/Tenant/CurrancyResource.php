<?php

namespace App\Http\Resources\Tenant;

class CurrancyResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'value' => $this->value,
            'code' => $this->currancy_code,
            'image' => public_asset($this->image),
            'status' => $this->status,
        ];
    }
}

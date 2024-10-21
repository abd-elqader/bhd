<?php

namespace App\Http\Resources\Tenant;

class RegionResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'lat' => $this->lat,
            'long' => $this->long,
            'delivery_cost' => $this->delivery_cost,
            'status' => $this->status,
            'blocks' => BlockResource::collection($this->Blocks),
        ];
    }
}

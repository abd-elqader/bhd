<?php

namespace App\Http\Resources\Tenant;

class CityResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'lat' => $this->lat,
            'long' => $this->long,
        ];
    }
}

<?php

namespace App\Http\Resources\Tenant;

class CountryResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'image' => public_asset($this->image),
            'lat' => $this->lat,
            'long' => $this->long,
            'length' => $this->length,
            'status' => $this->status,
            'accept_orders' => $this->accept_orders,
            'currancy_code' => $this->currancy_code,
            'currancy_value' => $this->currancy_value,
            'phone_code' => $this->phone_code,
            'country_code' => $this->country_code,
            'regions_count' => $this->regions_count,
        ];
    }
}

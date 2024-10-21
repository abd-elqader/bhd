<?php

namespace App\Http\Resources\Tenant;

class AddressResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'long' => $this->long,
            'block' => $this->Block->number ?? $this->block,
            'road' => $this->road,
            'floor_no' => $this->floor_no,
            'apartment' => $this->apartment,
            'building_no' => $this->building_no,
            'type' => $this->type,
            'additional_directions' => $this->additional_directions,
            'region' => RegionResource::make($this->region),
            'city' => CityResource::make($this->city),
            'client' => ClientResource::make($this->client),
        ];
    }
}

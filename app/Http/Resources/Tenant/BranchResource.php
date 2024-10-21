<?php

namespace App\Http\Resources\Tenant;

class BranchResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'lat' => $this->lat,
            'long' => $this->long,
            'address' => $this->address(),
            'working_time' => $this->working_time(),
            'delivery' => $this->delivery,
            'pickup' => $this->pickup,
            'dinein' => $this->dinein,
            'status' => $this->status,
            'distance' => $this->distance,
            'country' => CountryResource::make($this->Country),
            'periods' => PeriodResource::collection($this->WorkTime),
        ];
    }
}

<?php

namespace App\Http\Resources\Tenant;

class ClientResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => public_asset($this->image),
            'country_code' => $this->country_code,
            'phone_code' => $this->phone_code,
            'status' => $this->status,
        ];
    }
}

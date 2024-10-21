<?php

namespace App\Http\Resources\Tenant;

class RateResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'comment' => $this->comment,
            'client' => ClientResource::make($this->Client),
        ];
    }
}

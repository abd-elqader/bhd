<?php

namespace App\Http\Resources\Tenant;

class BlockResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'uuid' => $this->uuid,
        ];
    }
}

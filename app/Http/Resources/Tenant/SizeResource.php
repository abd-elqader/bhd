<?php

namespace App\Http\Resources\Tenant;

class SizeResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'status' => $this->status,
        ];
    }
}

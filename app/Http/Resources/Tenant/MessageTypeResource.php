<?php

namespace App\Http\Resources\Tenant;

class MessageTypeResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
        ];
    }
}

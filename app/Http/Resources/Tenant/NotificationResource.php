<?php

namespace App\Http\Resources\Tenant;

class NotificationResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}

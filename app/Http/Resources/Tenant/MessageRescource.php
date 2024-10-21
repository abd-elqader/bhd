<?php

namespace App\Http\Resources\Tenant;

class MessageRescource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'is_read' => $this->is_read,
            'from' => $this->type ? __('messages.Client') : __('messages.Admin'),
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}

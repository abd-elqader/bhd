<?php

namespace App\Http\Resources\Tenant;

class ComplaintResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'messages' => MessageRescource::collection($this->messages),
        ];
    }
}

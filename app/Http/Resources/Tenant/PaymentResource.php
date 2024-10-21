<?php

namespace App\Http\Resources\Tenant;

class PaymentResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'status' => $this->status,
            'images' => ImageResource::collection($this->Images),
        ];
    }
}

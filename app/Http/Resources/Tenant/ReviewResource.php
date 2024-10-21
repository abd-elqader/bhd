<?php

namespace App\Http\Resources\Tenant;

class ReviewResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => ClientResource::make($this->client),
            'rate' => $this->rate,
            'comment' => $this->comment,
        ];
    }
}

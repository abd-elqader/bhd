<?php

namespace App\Http\Resources\Tenant;

class SizeColorResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'color_id' => $this->Color ? $this->Color->id : null,
            'color' => $this->Color ? $this->Color->title() : null,
            'hexa' => $this->Color ? $this->Color->hexa : null,
            'images' => $this->images ?? [],
        ];
    }
}

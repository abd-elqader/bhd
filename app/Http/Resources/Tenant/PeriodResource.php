<?php

namespace App\Http\Resources\Tenant;

class PeriodResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'open' => $this->open,
            'close' => $this->close,
        ];
    }
}

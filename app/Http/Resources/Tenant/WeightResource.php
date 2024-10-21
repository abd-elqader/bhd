<?php

namespace App\Http\Resources\Tenant;

class WeightResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'weight' => $this->weight.' Kg',
            'price' => $this->price.DefaultCurrancy()->currancy_code,
            'status' => $this->status,
        ];
    }
}

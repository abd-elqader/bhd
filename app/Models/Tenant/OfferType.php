<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class OfferType extends BaseModel
{
    protected $guarded = [];

    public function Offers()
    {
        return $this->hasMany(Offer::class);
    }
}

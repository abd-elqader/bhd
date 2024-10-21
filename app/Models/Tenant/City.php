<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class City extends BaseModel
{
    protected $guarded = [];

    public function Region()
    {
        return $this->belongsTo(Region::class);
    }
}

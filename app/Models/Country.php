<?php

namespace App\Models;

use App\Models\Tenant\Branch;

class Country extends BaseModel
{
    protected $guarded = [];

    protected $withCount = ['Regions'];

    public function Regions()
    {
        return $this->hasMany(Region::class);
    }

    public function Branches()
    {
        if (tenant()) {
            return $this->hasMany(Branch::class);
        }
    }
}

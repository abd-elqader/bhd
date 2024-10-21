<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;
use App\Models\Region;

class Address extends BaseModel
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}

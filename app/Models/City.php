<?php

namespace App\Models;

class City extends BaseModel
{
    protected $guarded = [];

    public function Region()
    {
        return $this->belongsTo(Region::class);
    }
}

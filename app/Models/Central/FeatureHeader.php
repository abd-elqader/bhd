<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class FeatureHeader extends BaseModel
{
    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(Feature::class, 'header_id');
    }
}

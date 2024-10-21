<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class PackageFeature extends BaseModel
{
    protected $guarded = [];

    public function Package()
    {
        return $this->belongsTo(Package::class);
    }

    public function Feature()
    {
        return $this->belongsTo(Feature::class);
    }
}

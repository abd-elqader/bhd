<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class PackageDesc extends BaseModel
{
    protected $guarded = [];

    public function Packages()
    {
        return $this->belongsTo(Package::class);
    }
}

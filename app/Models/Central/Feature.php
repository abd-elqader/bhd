<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class Feature extends BaseModel
{
    protected $guarded = [];

    public function Header()
    {
        return $this->belongsTo(FeatureHeader::class);
    }

    public function Packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('title_ar', 'title_en');
    }
}

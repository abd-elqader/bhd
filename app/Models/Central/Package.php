<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class Package extends BaseModel
{
    protected $connection = 'mysql';
    protected $guarded = [];

    public function Features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('title_ar', 'title_en');
    }

    public function Descriptions()
    {
        return $this->hasMany(PackageDesc::class);
    }
    
    protected $appends = ['price_before','price_after'];

    public function getPriceBeforeAttribute()
    {
        return $this->price;
    }

    public function getPriceAfterAttribute()
    {
        return $this->price - ($this->price / 100 * $this->discount);
    }
    
    public function getPriceAttribute($price)
    {
        return $price;
    }
}

<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Traits\DeleteImage;

class Category extends BaseModel
{
    use  DeleteImage;

    protected $withCount = 'Products';

    protected $guarded = [];

    public function Products()
    {
        return $this->hasMany(ProductCategory::class);
    }
}

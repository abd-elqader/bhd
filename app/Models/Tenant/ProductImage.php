<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Traits\DeleteImage;

class ProductImage extends BaseModel
{
    use DeleteImage;

    protected $table = 'product_images';

    protected $guarded = [];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}

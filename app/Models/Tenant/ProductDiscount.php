<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductDiscount extends BaseModel
{
    protected $table = 'product_discounts';

    protected $guarded = [];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}

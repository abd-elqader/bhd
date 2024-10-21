<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductCategory extends BaseModel
{
    protected $table = 'product_categories';

    protected $with = ['Category', 'Product'];

    protected $guarded = [];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}

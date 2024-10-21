<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class OrderProduct extends BaseModel
{
    protected $guarded = [];

    protected $table = 'order_product';

    protected $with = ['Product', 'Size', 'Color'];

    public function Additions()
    {
        return $this->hasMany(OrderProductAdditions::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }
}

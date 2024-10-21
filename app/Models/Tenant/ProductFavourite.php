<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;

class ProductFavourite extends BaseModel
{
    protected $table = 'product_favourites';

    protected $guarded = [];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
}

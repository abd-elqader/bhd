<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class Offer extends BaseModel
{
    protected $guarded = [];

    protected $with = ['ProductsData', 'Products'];

    public function Type()
    {
        return $this->belongsTo(OfferType::class);
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'offer_products')->withPivot('for');
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'offer_categories')->withPivot('for');
    }

    public function ProductsData()
    {
        return $this->hasOne(OfferProductsData::class);
    }

    public function CategoriesData()
    {
        return $this->hasOne(OfferCategoriesData::class);
    }
}

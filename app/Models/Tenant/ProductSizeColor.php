<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class ProductSizeColor extends BaseModel
{
    protected $table = 'product_size_color';

    protected $guarded = [];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public function Weight()
    {
        return $this->belongsTo(Weight::class);
    }

    public function getPriceAttribute()
    {
        return number_format($this->original['price'] * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '');
    }

    public function hasDiscount()
    {
        return $this->discount && $this->from < now() && $this->to > now();
    }

    public function CalcPrice()
    {
        // dd($this->price);
        if ($this->discount && $this->from < now() && $this->to > now()) {
            return number_format($this->price - ($this->price / 100 * $this->discount), DefaultCurrancy()->decimals, '.', '');
        } else {
            return number_format($this->price, DefaultCurrancy()->decimals, '.', '');
        }
    }

    public function Price()
    {
        return number_format($this->price * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
    }
}

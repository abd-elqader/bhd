<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;

class Cart extends BaseModel
{
    protected $model;

    protected $guarded = [];

    protected $table = 'carts';

    protected $with = ['Product', 'Size', 'Color'];

    protected $appends = ['price', 'price_after_discount', 'total', 'total_after_discount', 'discount', 'discount_percentage'];

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {
            $model->model = $model->Product?->SizeColor->where('size_id', $model->size_id)->when($model->color_id > 0, function ($q) use ($model) {
                return $q->where('color_id', $model->color_id);
            })->first();
        });
    }

    public function getPriceAttribute()
    {
        return number_format($this->model->price * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '');
    }

    public function getPriceAfterDiscountAttribute()
    {
        return number_format($this->model->CalcPrice(), DefaultCurrancy()->decimals, '.', '');
    }

    public function getDiscountAttribute()
    {
        return number_format(($this->price - $this->price_after_discount) * $this->quantity, DefaultCurrancy()->decimals, '.', '');
    }

    public function getDiscountPercentageAttribute()
    {
        return (int) $this->model->discount;
    }

    public function getTotalAttribute()
    {
        return number_format($this->price * $this->quantity, DefaultCurrancy()->decimals, '.', '');
    }

    public function getTotalAfterDiscountAttribute()
    {
        return number_format((float) $this->price_after_discount * $this->quantity, DefaultCurrancy()->decimals, '.', '');
    }
}

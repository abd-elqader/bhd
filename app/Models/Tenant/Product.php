<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel implements Viewable
{
    use InteractsWithViews, SoftDeletes;

    protected $guarded = [];

    protected $with = ['Images', 'SizeColor.color', 'SizeColor.size'];

    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function Offer()
    {
        return $this->belongsToMany(Offer::class, 'offer_products')->withPivot('for');
    }

    public function Images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function SizeColor()
    {
        return $this->hasMany(ProductSizeColor::class);
    }

    public function Rates()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function RandomImage()
    {
        return $this->Images->first()?->image ?? setting('logo');
    }

    public function SaleProducts()
    {
        return $this->hasMany(ProductSizeColor::class)->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now());
    }

    public function OrdersProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function FavProducts()
    {
        return $this->hasMany(ProductFavourite::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Client::class, 'product_favourites');
    }

    public function IsFav()
    {
        return $this->belongsToMany(Client::class, 'product_favourites')->wherePivot('client_id', auth('sanctum')->id() ?? auth('client')->id())->count() > 0;
    }

    public function rate()
    {
        return $this->Rates->avg('rate') ?? 0;
    }

    public function Price()
    {
        if ($this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->count()) {
            $SizeColor = $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->first();

            return number_format(($SizeColor->price) * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        } else {
            return number_format($this->SizeColor->first()->price * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        }
    }

    public function HasDiscount()
    {
        return $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->count();
    }

    public function Discount()
    {
        return (int) $this->SizeColor->first()->discount ?? 0;
    }

    public function DiscountTo()
    {
        return $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->first()->to;
    }

    public function DiscountSize()
    {
        return $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->first()->Size->title() ?? null;
    }

    public function DiscountColor()
    {
        return $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->first()->Color->title() ?? null;
    }

    public function CalcPrice()
    {
        if ($this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->count()) {
            $SizeColor = $this->SizeColor->where('discount', '>', 0)->where('from', '<', now())->where('to', '>', now())->first();

            return number_format(($SizeColor->price - ($SizeColor->price / 100 * $SizeColor->discount)) * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        } else {
            return number_format($this->SizeColor->first()->price * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        }
    }
}

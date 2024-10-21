<?php

namespace App\Http\Resources\Tenant;

use App\Models\Tenant\Color;
use App\Models\Tenant\Product;
use App\Models\Tenant\Size;

class OrderProductResource extends BaseResource
{
    public function toArray($request)
    {
        $Product = Product::find($this->product_id);

        return [
            'id' => $this->id,
            'price' => number_format($this->price * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'quantity' => $this->quantity,
            'total' => number_format($this->total * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'product_id' => $this->product_id,
            'product_title' => $Product?->title(),
            'product_image' => public_asset($Product?->RandomImage()),
            'size' => SizeResource::make(Size::find($this->size_id)),
            'color' => ColorResource::make(Color::find($this->color_id)),
        ];
    }
}

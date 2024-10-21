<?php

namespace App\Http\Resources\Tenant;

class CartResource extends BaseResource
{
    public function toArray($request)
    {
        $product = $this->Product;

        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'discount' => $this->discount.' '.DefaultCurrancy()->currancy_code,
            'discount_percentage' => (int) $this->discount_percentage,
            'price_before' => $this->price.' '.DefaultCurrancy()->currancy_code,
            'price_after' => $this->price_after_discount.' '.DefaultCurrancy()->currancy_code,
            'total_before' => $this->total.' '.DefaultCurrancy()->currancy_code,
            'total_after' => $this->total_after_discount.' '.DefaultCurrancy()->currancy_code,
            'note' => $this->note,
            'product_id' => $product->id,
            'product_title' => $product->title(),
            'product_image' => public_asset($product->RandomImage()),
            'size' => SizeResource::make($this->Size),
            'color' => ColorResource::make($this->Color),
        ];
    }
}

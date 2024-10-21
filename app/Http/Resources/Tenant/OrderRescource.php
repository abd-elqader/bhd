<?php

namespace App\Http\Resources\Tenant;

use App\Models\Tenant\OrderProduct;

class OrderRescource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'delivery_id' => $this->delivery_id,
            'payment_id' => $this->payment_id,
            'address_id' => $this->address_id,
            'branch_id' => $this->branch_id,
            'subTotal' => number_format($this->sub_total * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'discount' => number_format($this->discount * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'discount_percentage' => $this->discount_percentage,
            'vat' => number_format($this->vat * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'VAT_percentage' => $this->vat_percentage,
            'coupon' => number_format($this->coupon * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'coupon_percentage' => $this->coupon_percentage,
            'charge_cost' => number_format($this->charge_cost * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'netTotal' => number_format($this->net_total * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code,
            'use_points' => $this->use_points,
            'points_number' => $this->points_number,
            'gained_points' => $this->gained_points,
            'client_points' => $this->client_points,
            'mobile_type' => $this->mobile_type,
            'status' => (int) $this->status,
            'follow' => (int) $this->follow,
            'created_at' => $this->created_at,
            'address' => AddressResource::make($this->address),
            'products' => OrderProductResource::collection(OrderProduct::where('order_id', $this->id)->get()),
        ];
    }
}

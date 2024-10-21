<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;
use App\Models\Payment;

class Order extends BaseModel
{
    protected $guarded = [];

    protected $with = ['products', 'payment', 'delivery'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot(['color_id', 'size_id', 'price', 'quantity', 'total']);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivry::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function OrderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function DeliveryMethod()
    {
        return $this->belongsTo(Delivry::class, 'delivery_id');
    }

    public function PaymentMethod()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}

<?php

namespace App\Models;

class Payment extends BaseModel
{
    protected $guarded = [];

    protected $table = 'payments';

    public function Images()
    {
        return $this->hasMany(PaymentImages::class, 'payment_id');
    }
}

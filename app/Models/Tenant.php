<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, SoftDeletes;
    use HasFactory, Status;

    protected $guarded = [];

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
    public function DeliveryIn()
    {
        return $this->belongsTo(\App\Models\Central\Delivery::class,'delivry_id_in');
    }
    public function DeliveryOut()
    {
        return $this->belongsTo(\App\Models\Central\Delivery::class,'delivry_id_out');
    }
}

<?php

namespace App\Models;

use App\Models\Central\Package;
use App\Models\Tenant\Address;
use App\Models\Tenant\Order;
use App\Models\Tenant\Product;
use App\Traits\DeleteImage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes, DeleteImage;

    protected $guarded = [];

    protected $table = 'clients';

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Product::class, 'product_favourites', 'client_id', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function Packages()
    {
        return $this->belongsToMany(Package::class, 'package_users', 'client_id', 'package_id')->orderBy('start_date','desc')->withPivot('start_date','end_date','paid')->withTimestamps();
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function __construct()
    {
        if (tenant()) {
            $this->with = ['addresses.region', 'orders', 'favourites'];
        }
    }

    public function AdminDeviceToken()
    {
        return $this->hasMany(AdminDeviceToken::class);
    }

    public function DeviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }
}

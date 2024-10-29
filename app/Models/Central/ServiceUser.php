<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    protected $connection = 'mysql';
    protected $guarded = [];
    use HasFactory;

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
}

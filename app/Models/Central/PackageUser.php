<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    protected $connection = 'mysql';
    protected $guarded = [];
    use HasFactory;
    
    public function Package()
    {
        return $this->belongsTo(Package::class);
    }
}

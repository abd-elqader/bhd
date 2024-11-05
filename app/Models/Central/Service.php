<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class Service extends BaseModel
{
    protected $connection = 'mysql';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(ServiceUser::class);
    }

}

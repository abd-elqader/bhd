<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Traits\DeleteImage;

class Currancy extends BaseModel
{
    use DeleteImage;

    protected $guarded = [];
}

<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class Removes extends BaseModel
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->arrangement = $model->id;
            $model->save();
        });
    }
}

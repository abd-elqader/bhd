<?php

namespace App\Traits;

use App\Models\Localization;

trait Locales
{
    public function locales()
    {
        return $this->morphMany(Localization::class, 'localable');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($Model) {
            $Model->locales()->delete();
        });
    }
}

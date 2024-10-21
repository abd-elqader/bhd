<?php

namespace App\Models;

class Localization extends BaseModel
{
    protected $table = 'localizations';

    protected $guarded = [];

    public function localable()
    {
        return $this->morphTo();
    }
}

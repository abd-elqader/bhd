<?php

namespace App\Models\Central;

use App\Models\BaseModel;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Blog extends BaseModel
{
    use HasTrixRichText;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($blog) {
            $blog->trixRichText->each->delete();
            $blog->trixAttachments->each->purge();
        });
    }
}

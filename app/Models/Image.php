<?php

namespace App\Models;

use App\Traits\DeleteImage;

class Image extends BaseModel
{
    use  DeleteImage;

    protected $guarded = [];

    public function Type()
    {
        return $this->belongsTo(ImageType::class);
    }
}

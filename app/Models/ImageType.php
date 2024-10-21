<?php

namespace App\Models;

class ImageType extends BaseModel
{
    protected $table = 'image_types';

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class, 'type_id');
    }
}

<?php

namespace App\Traits;

use App\Helper\Upload;

trait DeleteImage
{
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($Model) {
            if(tenant()?->id == 'demo'){
                return back();
            }
            if ($Model->image) {
                Upload::deleteImage($Model->image);
            }
        });
    
        // static::creating(function ($Model) {
        //     if(tenant()?->id == 'demo'){
        //         return back();
        //     }
        // });
        // static::updating(function ($Model) {
        //     if(tenant()?->id == 'demo'){
        //         return back();
        //     }
        // });

    }
}

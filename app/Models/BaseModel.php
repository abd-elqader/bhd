<?php

namespace App\Models;

use App\Traits\DeleteImage;
use App\Traits\Status;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory, Status, DeleteImage, Translate;

    public function getCreatedAtAttribute($date)
    {
        $date = \Carbon\Carbon::parse($date);

        return  $date->format('d-m-Y g:i a');

        return  $date->diffForHumans(\Carbon\Carbon::now());
    }
    
   
}

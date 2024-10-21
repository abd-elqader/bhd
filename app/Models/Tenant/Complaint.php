<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class Complaint extends BaseModel
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(\Client::class)->withTrashed();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

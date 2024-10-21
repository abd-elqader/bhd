<?php

namespace App\Models;

class DeviceToken extends BaseModel
{
    protected $guarded = [];

    protected $table = 'device_tokens';

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}

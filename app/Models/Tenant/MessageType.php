<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;

class MessageType extends BaseModel
{
    protected $guarded = [];

    protected $table = 'message_types';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:sA',
    ];

    public function Notifications()
    {
        return $this->hasMany(Notification::class);
    }
}

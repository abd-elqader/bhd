<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Client;

class Message extends BaseModel
{
    protected $guarded = [];

    protected $table = 'messages';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:sA',
    ];

    public function Type()
    {
        return $this->belongsTo(MessageType::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
}

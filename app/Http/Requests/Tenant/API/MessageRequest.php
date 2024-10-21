<?php

namespace App\Http\Requests\Tenant\API;

class MessageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'content' => ['required'],
            'type_id' => ['nullable'],
            'complaint_id' => ['nullable'],
            'is_read' => ['nullable'],
        ];
    }
}

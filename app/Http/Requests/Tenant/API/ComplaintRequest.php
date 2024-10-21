<?php

namespace App\Http\Requests\Tenant\API;

class ComplaintRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'content' => ['nullable'],
        ];
    }
}

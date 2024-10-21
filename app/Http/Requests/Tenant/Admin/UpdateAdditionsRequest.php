<?php

namespace App\Http\Requests\Tenant\Admin;

class  UpdateAdditionsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests\Tenant\Admin;

class  UpdateColorRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'hexa' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}

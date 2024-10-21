<?php

namespace App\Http\Requests\Tenant\Admin;

class  UpdateCurrancyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'code' => ['required', 'string'],
            'value' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
}

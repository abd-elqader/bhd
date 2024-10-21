<?php

namespace App\Http\Requests\Mix\Admin;

class UpdateCountryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048', 'image'],
            'code' => ['required', 'string'],
            'value' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
}

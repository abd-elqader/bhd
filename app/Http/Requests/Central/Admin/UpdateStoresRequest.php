<?php

namespace App\Http\Requests\Central\Admin;

class  UpdateStoresRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'desc_ar' => ['nullable', 'string'],
            'desc_en' => ['nullable', 'string'],
            'website' => ['nullable', 'image', 'max:2048'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
            'link' => ['nullable', 'string'],
        ];
    }
}

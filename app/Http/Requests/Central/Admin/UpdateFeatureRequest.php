<?php

namespace App\Http\Requests\Central\Admin;

class  UpdateFeatureRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['nullable', 'required_without_all:image', 'string'],
            'title_en' => ['nullable', 'required_without_all:image', 'string'],
            'image' => ['nullable', 'required_without_all:title_ar,title_en', 'image', 'max:2048', 'image'],
            'type' => ['required', 'string', 'in:icon,text'],
            'header_id' => ['required', 'exists:feature_headers,id'],
            'status' => ['required', 'boolean'],
        ];
    }
}

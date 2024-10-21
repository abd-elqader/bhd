<?php

namespace App\Http\Requests\Mix\Admin;

class  UpdateImageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'desc_ar' => ['nullable', 'string'],
            'desc_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048', 'image'],
            'status' => ['required', 'boolean'],
            'type_id' => ['required', 'exists:image_types,id'],
        ];
    }
}

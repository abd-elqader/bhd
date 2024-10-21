<?php

namespace App\Http\Requests\Central\Admin;

class  UpdateComponentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'type' => ['required', 'string'],
            'path' => ['required', 'string'],
            'preview' => ['nullable', 'image'],
        ];
    }
}

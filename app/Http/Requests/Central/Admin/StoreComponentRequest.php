<?php

namespace App\Http\Requests\Central\Admin;

class StoreComponentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'type' => ['required', 'string'],
            'path' => ['required', 'string'],
            'preview' => ['required', 'image'],
        ];
    }
}

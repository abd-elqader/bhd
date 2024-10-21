<?php

namespace App\Http\Requests\Tenant\Admin;

class  UpdateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'image' => ['sometimes', 'required', 'image', 'max:2048', 'image'],
            'status' => ['required', 'boolean'],
        ];
    }
}

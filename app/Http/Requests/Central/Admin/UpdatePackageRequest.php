<?php

namespace App\Http\Requests\Central\Admin;

class  UpdatePackageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            // 'price_ar' => ['required', 'string'],
            // 'price_en' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],

            'desc_title_ar' => ['nullable'],
            'desc_title_ar.*' => ['nullable', 'string'],
            'desc_title_en' => ['nullable'],
            'desc_title_en.*' => ['nullable', 'string'],

            'feature_id' => ['nullable'],
            'feature_id*' => ['nullable', 'boolean'],
            'feature_title_ar' => ['nullable'],
            'feature_title_ar*' => ['nullable', 'boolean'],
            'feature_title_en' => ['nullable'],
            'feature_title_en*' => ['nullable', 'boolean'],
        ];
    }
}

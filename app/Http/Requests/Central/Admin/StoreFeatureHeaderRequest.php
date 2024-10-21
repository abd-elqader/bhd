<?php

namespace App\Http\Requests\Central\Admin;

class  StoreFeatureHeaderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
        ];
    }
}

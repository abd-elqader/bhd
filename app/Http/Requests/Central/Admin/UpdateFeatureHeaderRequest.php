<?php

namespace App\Http\Requests\Central\Admin;

class  UpdateFeatureHeaderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
        ];
    }
}

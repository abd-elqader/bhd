<?php

namespace App\Http\Requests\Mix\Admin;

class  UpdateImageTypeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
        ];
    }
}

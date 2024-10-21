<?php

namespace App\Http\Requests\Tenant\Admin;

class UpdateBranchRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],

            'lat' => ['required', 'string'],
            'long' => ['required', 'string'],

            'close' => ['nullable'],
            'close.*' => ['nullable'],
            'open' => ['nullable'],
            'open.*' => ['nullable'],
        ];
    }
}

<?php

namespace App\Http\Requests\Tenant\Admin;

class StoreBranchRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],

            'lat' => ['nullable', 'string'],
            'long' => ['nullable', 'string'],

            'close' => ['nullable'],
            'close.*' => ['nullable'],
            'open' => ['nullable'],
            'open.*' => ['nullable'],

        ];
    }
}

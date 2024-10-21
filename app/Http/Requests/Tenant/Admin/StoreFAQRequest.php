<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreFAQRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'question_ar' => ['required', 'string'],
            'question_en' => ['required', 'string'],

            'answer_ar' => ['required', 'string'],
            'answer_en' => ['required', 'string'],

            'status' => ['required', 'boolean'],
        ];
    }
}

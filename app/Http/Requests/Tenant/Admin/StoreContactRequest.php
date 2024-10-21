<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreContactRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits_between:8,12'],
            'name' => ['required', 'between:3,20'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ];
    }
}

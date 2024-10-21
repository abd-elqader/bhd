<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreOfferTypeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}

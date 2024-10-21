<?php

namespace App\Http\Requests\Tenant\Admin;

class  UpdateOfferRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'image' => ['nullable',  'image', 'max:2048', 'image'],
            'status' => ['required', 'boolean'],
            'value' => ['nullable', 'numeric'],
            'type_id' => ['required', 'exists:offer_types,id'],
        ];
    }
}

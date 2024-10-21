<?php

namespace App\Http\Requests\Mix\Admin;

class  StoreSettingRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'key' => ['required', 'string'],
            'type' => ['required', 'string'],
            'valuetype' => ['required', 'string'],
            'value' => ['string'],
            'Imagevalue' => ['image'],
        ];
    }
}

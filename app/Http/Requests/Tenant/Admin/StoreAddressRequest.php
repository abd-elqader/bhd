<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreAddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'client_id' => ['required', 'nullable', 'exists:clients,id'],
            'region_id' => ['required', 'exists:regions,id'],

            'lat' => ['required', 'string'],
            'long' => ['required', 'string'],

            'block' => ['required', 'string'],
            'road' => ['required', 'string'],
            'floor_no' => ['required', 'string'],
            'apartment' => ['required', 'string'],
            'building_no' => ['nullable', 'string'],
            'type' => ['required'],
            'additional_directions' => ['nullable', 'string'],
        ];
    }
}

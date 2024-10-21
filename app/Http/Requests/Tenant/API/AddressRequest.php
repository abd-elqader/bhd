<?php

namespace App\Http\Requests\Tenant\API;

class AddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'region_id' => ['required', 'exists:regions,id'],
            'city_id' => ['nullable', 'exists:cities,id'],

            'lat' => ['nullable'],
            'long' => ['nullable'],

            'block_id' => ['nullable'],
            'block' => ['nullable'],
            'road' => ['nullable'],
            'floor_no' => ['nullable'],
            'apartment' => ['nullable'],
            'building_no' => ['nullable'],
            'type' => ['nullable'],
            'additional_directions' => ['nullable'],
        ];
    }
}

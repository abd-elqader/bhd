<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreCouponRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'code' => ['required', 'string'],
            'type' => ['required', 'string'],

            'discount' => ['nullable', 'required_without:percent_off', 'numeric'],
            'percent_off' => ['nullable', 'required_without:discount', 'numeric'],

            'from' => ['required', 'date'],
            'to' => ['required', 'date'],

            'status' => ['required', 'boolean'],
        ];
    }
}

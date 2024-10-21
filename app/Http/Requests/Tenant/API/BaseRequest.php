<?php

namespace App\Http\Requests\Tenant\API;

use App\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class  BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function failedValidation($validator)
    {
        return ResponseHelper::make(null, $validator->errors()->first(), false, 404);
    }
}

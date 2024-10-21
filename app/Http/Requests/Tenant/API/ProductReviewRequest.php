<?php

namespace App\Http\Requests\Tenant\API;

class ProductReviewRequest extends BaseRequest
{
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'product_id' => ['required', 'exists:products,id'],
                'rate' => ['required', 'numeric', 'min:0', 'max:5'],
                'comment' => ['nullable'],
            ];
        } else {
            return [
                'product_id' => ['nullable', 'exists:products,id'],
                'rate' => ['nullable', 'numeric', 'min:0', 'max:5'],
                'comment' => ['nullable'],
            ];
        }
    }
}

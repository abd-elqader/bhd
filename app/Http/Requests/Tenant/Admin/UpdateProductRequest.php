<?php

namespace App\Http\Requests\Tenant\Admin;

use App\Http\Requests\Tenant\Admin\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],

            'desc_ar' => ['nullable', 'string'],
            'desc_en' => ['nullable', 'string'],

            'quantity' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],

            'VAT' => ['required', 'string', 'in:inclusive,exclusive'],
            'most_selling' => ['nullable', 'boolean'],
            'popular' => ['nullable', 'boolean'],
            'status' => ['required', 'boolean'],
            'have_discount' => ['required', 'boolean'],
            'filter' => ['required', Rule::in(['neither', 'has_size', 'has_color', 'has_size_color'])],

            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],

            'images' => ['nullable', 'array'],
            'images.*' => ['image'],
        ];
        
        if (request()->filter == 'has_size') {
            $rules += [
                'sizes' => ['required', 'array'],
                'sizes.*' => ['required','exists:sizes,id'],
            ];
        }elseif (request()->filter == 'has_color') {
            $rules += [
                'colors' => ['required', 'array'],
                'colors.*' => ['required','exists:colors,id'],
            ];
        }elseif (request()->filter == 'has_size_color') {
            $rules += [
                'sizes' => ['required', 'array'],
                'sizes.*' => ['required','exists:sizes,id'],
                
                'colors' => ['required', 'array'],
                'colors.*' => ['required','exists:colors,id'],
            ];
        }
        
        

        if (request()->have_discount) {
            $rules += [
                'discount' => ['required'],
                'from' => ['required'],
                'to' => ['required'],
            ];
        }

        return $rules;
    }
}
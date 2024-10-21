<?php

namespace App\Http\Requests\Tenant\Admin;

class  StoreOfferRequest extends BaseRequest
{
    public function rules()
    {
        $roles = [
            'title_ar' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'start_at' => ['required', 'string'],
            'end_at' => ['required', 'string'],
            'status' => ['required', 'boolean'],
            'type_id' => ['required', 'exists:offer_types,id'],
            'image' => ['nullable',  'image', 'max:2048', 'image'],
        ];
        if (request()['for_id'] == 'products') {
            if (request()['type_id'] == 1) {
                $roles += [
                    'products.1.x.quantity' => ['required', 'numeric'],
                    'products.1.x.product_ids.*' => ['required', 'exists:products,id'],
                    'products.1.y.type' => ['required', 'in:items,discount'],
                ];
                if (isset(request()['products']['1']['y']['for']) && request()['products']['1']['y']['for'] == 'items') {
                    $roles += [
                        'products.1.y.items.quantity' => ['required', 'numeric'],
                    ];
                } elseif (isset(request()['products']['1']['y']['type']) && request()['products']['1']['y']['type'] == 'discount') {
                    $roles += [
                        'products.1.y.discount.value' => ['required', 'numeric'],
                        'products.1.y.discount.type' => ['required', 'in:percentage,fixedprice'],
                    ];
                }
            } elseif (request()['type_id'] == 2) {
                $roles += [
                    'products.2.value' => ['required', 'numeric'],
                    'products.2.product_ids.*' => ['required', 'exists:products,id'],
                ];
            } elseif (request()['type_id'] == 3) {
                $roles += [
                    'products.3.value' => ['required', 'numeric'],
                    'products.3.product_ids.*' => ['required', 'exists:products,id'],
                ];
            }
        } elseif (request()['for_id'] == 'categories') {
            if (request()['type_id'] == 1) {
                $roles += [
                    'categories.1.x.quantity' => ['required', 'numeric'],
                    'categories.1.x.category_ids.*' => ['required', 'exists:categories,id'],
                    'categories.1.y.for' => ['required', 'in:products,categories'],

                    'categories.1.y.type' => ['required', 'in:quantity,fixedprice,percentage'],
                ];
                if (isset(request()['categories']['1']['y'])) {
                    if (isset(request()['categories']['1']['y']['for']) && request()['categories']['1']['y']['for'] == 'categories') {
                        $roles += [
                            'categories.1.y.categories.category_ids.*' => ['required', 'exists:categories,id'],
                        ];
                    } elseif (isset(request()['categories']['1']['y']['for']) && request()['categories']['1']['y']['for'] == 'products') {
                        $roles += [
                            'categories.1.y.products.product_ids.*' => ['required', 'exists:products,id'],
                        ];
                    }
                }

                if (isset(request()['categories']['1']['y']['type']) && request()['categories']['1']['y']['type'] == 'quantity') {
                    $roles += [
                        'categories.1.y.quantity' => ['nullable', 'numeric'],
                    ];
                } elseif (isset(request()['categories']['1']['y']['type']) && in_array(request()['categories']['1']['y']['type'], ['fixedprice', 'percentage'])) {
                    $roles += [
                        'categories.1.y.value' => ['nullable', 'numeric'],
                    ];
                }
            } elseif (request()['type_id'] == 2) {
                $roles += [
                    'categories.2.value' => ['required', 'numeric'],
                    'categories.2.category_ids.*' => ['required', 'exists:categories,id'],
                ];
            } elseif (request()['type_id'] == 3) {
                $roles += [
                    'categories.3.value' => ['required', 'numeric'],
                    'categories.3.category_ids.*' => ['required', 'exists:categories,id'],
                ];
            }
        }

        return $roles;
    }
}

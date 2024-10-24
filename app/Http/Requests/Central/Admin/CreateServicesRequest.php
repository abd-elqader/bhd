<?php

namespace App\Http\Requests\Central\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "service_title" => "required",
            "service_description" => "required",
            "service_price" => "required",
            "service_image" => "required",
        ];
    }
    public function messages()
    {
        return [
            "service_title.required" => "عنوان الخدمة مطلوب",
            "service_description.required" => "وصف الخدمة مطلوب",
            "service_price.required" => "سعر الخدمة مطلوب",
            "service_image.required" => "صورة الخدمة مطلوبة",
        ];
    }
}

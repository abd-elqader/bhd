<?php

namespace App\Http\Requests\Mix\User;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function withValidator($validator)
    {
        foreach ($validator->messages()->all() as $message) {
            alert()->error($message);
        }

        return redirect()->back()->withErrors($validator);
    }
}

<?php

namespace App\Http\Requests\Tenant\User;

class  LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|digits_between:8,12',
            'password' => 'required|min:6',
            'type' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $messages = $validator->messages();
        foreach ($messages->all() as $message) {
            alert()->error($message);
        }

        return redirect()->back()->with(request()->all());
    }
}

<?php

namespace App\Http\Requests\Central\Admin;

class  StoreTenantRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'subdomain' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,id'],
            'client_id' => ['required', 'numeric', 'exists:clients,id'],
        ];
    }
}

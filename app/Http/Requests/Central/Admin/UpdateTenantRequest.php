<?php

namespace App\Http\Requests\Central\Admin;

class  UpdateTenantRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,id,'.$this->id],
            // 'client_id' => ['required', 'numeric', 'exists:clients,id'],
            // 'tenancy_db_name' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,id,'.$this->id],
        ];
    }
}

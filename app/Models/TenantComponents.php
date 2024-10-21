<?php

namespace App\Models;

class TenantComponents extends BaseModel
{
    protected $guarded = [];

    public function themePages()
    {
        return $this->belongsToMany(ThemePage::class, 'theme_pages_components', 'tenant_component_id', 'theme_page_id')->withPivot('row_id');
    }
}

<?php

namespace App\Models;

class ThemePage extends BaseModel
{
    protected $guarded = [];

    protected $with = ['tenantComponents'];

    public function tenantComponents()
    {
        return $this->belongsToMany(TenantComponents::class, 'theme_pages_components', 'theme_page_id', 'tenant_component_id')->withPivot('row_id');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'theme_pages_themes', 'theme_page_id', 'theme_id');
    }
}

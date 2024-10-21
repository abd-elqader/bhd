<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class Component extends BaseModel
{
    protected $guarded = [];

    protected $connection = 'mysql';

    public function defaultThemePages()
    {
        return $this->belongsToMany(DefaultThemePage::class, 'default_theme_pages_components', 'component_id', 'default_theme_page_id')->withPivot('row_id');
    }
}

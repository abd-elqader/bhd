<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class DefaultThemePage extends BaseModel
{
    protected $connection = 'mysql';

    protected $guarded = [];

    protected $with = ['components'];

    public function components()
    {
        return $this->belongsToMany(Component::class, 'default_theme_pages_components', 'default_theme_page_id', 'component_id')->withPivot('row_id');
    }

    public function defaultThemes()
    {
        return $this->belongsToMany(DefaultTheme::class, 'default_theme_pages_default_themes', 'default_theme_page_id', 'default_theme_id');
    }
}

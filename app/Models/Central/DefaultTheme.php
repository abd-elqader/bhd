<?php

namespace App\Models\Central;

use App\Models\BaseModel;

class DefaultTheme extends BaseModel
{
    protected $connection = 'mysql';

    protected $guarded = [];

    // protected $with = ['defaultThemePages'];

    public function defaultThemePages()
    {
        return $this->belongsToMany(DefaultThemePage::class, 'default_theme_pages_default_themes', 'default_theme_id', 'default_theme_page_id');
    }
}

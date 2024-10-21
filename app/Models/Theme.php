<?php

namespace App\Models;

use App\Models\Central\Component;

class Theme extends BaseModel
{
    protected $guarded = [];

    protected $with = ['themePages'];

    protected $connecion = 'tenant';

    private function Component()
    {
        return $this->belongsToMany(Component::class, 'theme_components');
    }

    public function themePages()
    {
        return $this->belongsToMany(ThemePage::class, 'theme_pages_themes', 'theme_id', 'theme_page_id');
    }
}

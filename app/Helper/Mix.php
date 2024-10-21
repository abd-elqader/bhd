<?php

use App\Models\Country;
use App\Models\Image;
use App\Models\ImageType;
use App\Models\Setting;
use App\Models\Tenant\Branch;
use Illuminate\Support\Facades\Config;

function lang($lang = null)
{
    if (isset($lang)) {
        return app()->islocale($lang);
    } else {
        return app()->getlocale();
    }
}

function Countries()
{
    if (! Config::get('Countries')) {
        Config::set('Countries', Country::Active()->get());
    }

    return Config::get('Countries');
}

function Currancies()
{
    return Countries();
}

function DefaultCurrancy()
{
    if (! Config::get('DefaultCurrancy')) {
        Config::set('DefaultCurrancy', Countries()->where('id', request()->currency_id ?? (session()->get('DefaultCurrancy') ?? (setting('DefaultCurrancy') ?? 1)))->first());
    }

    return Config::get('DefaultCurrancy');
}
function MainCurrancy()
{
    return Countries()->where('id', setting('DefaultCurrancy'))->first();
}

function Settings()
{
    if (! Config::get('Settings')) {
        Config::set('Settings', Setting::Active()->get());
    }

    return Config::get('Settings');
}

function Types()
{
    if (! Config::get('Types')) {
        Config::set('Types', ImageType::Active()->with('Images')->get());
    }
    $Types = Config::get('Types');
    foreach($Types as $type){
        $type->images = $type->images->where('status',1);
    }
    return $Types;
}

function ImageType($name)
{
    if (is_int($name)) {
        return Types()->where('id', $name)->first();
    } else {
        return Types()->where('title_en', $name)->first();
    }
}

function Images()
{
    if (! Config::get('Images')) {
        Config::set('Images', Image::Active()->get());
    }

    return Config::get('Images');
}

function setting($key)
{
    return Settings()->where('key', $key)->first()->value ?? null;
}

function DT_Lang()
{
    if (lang('ar')) {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json';
    } else {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/English.json';
    }
}
function public_asset($path,$secure = null) {
    if(!$path)
        return str_replace(tenant()?->id . '.', "", app('url')->asset(setting('logo'), $secure));
            
    if(tenant())
        return str_replace(tenant()->id . '.', "", app('url')->asset($path, $secure));

    return app('url')->asset($path, $secure);
}


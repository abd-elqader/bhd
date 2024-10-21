<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function settings($lang, Request $request)
    {
        $Settings = Setting::get()->keyBy('key');
        foreach ($Settings as $key => $item) {
            $Settings[$key] = $item->value;
        }
        return ResponseHelper::make($Settings);
    }
    public function google_ads($lang, Request $request)
    {
        $Settings["google_ads"]  = Setting::where('key','google_ads')->first()->value;
        return ResponseHelper::make($Settings);
    }
    
    public function contact($lang, Request $request)
    {
        $Settings = Setting::whereIn('type', ['public', 'address'])->whereNotIn('key', ['DefaultCurrancy'])->get(['key', 'value', 'type'])->keyBy('key');

        return ResponseHelper::make($this->SetUpSettings($Settings));
    }

    public function privacy($lang, Request $request)
    {
        $Settings = Setting::where('type', 'privacy')->get(['key', 'value', 'type'])->keyBy('key');

        return ResponseHelper::make($this->SetUpSettings($Settings));
    }

    public function about($lang, Request $request)
    {
        $Settings = Setting::where('type', 'about')->get(['key', 'value', 'type'])->keyBy('key');

        return ResponseHelper::make($this->SetUpSettings($Settings));
    }

    public function terms($lang, Request $request)
    {
        $Settings = Setting::where('type', 'terms')->orWhereIn('key', ['website', 'phone'])->get(['key', 'value', 'type'])->keyBy('key');

        return ResponseHelper::make($this->SetUpSettings($Settings));
    }

    public function support($lang, Request $request)
    {
        $Settings = [
            'title' => 'In case of any technical problem in the application please contact the following number - في حالة وجود اي مشكلة فنية في التطبيق برجاء التواصل على الرقم التالي',
            'number' => setting('phone'),
        ];

        return ResponseHelper::make($Settings);
    }

    public function SetUpSettings($Settings)
    {
        $Models = collect();
        foreach ($Settings as $key => $item) {
            if (str_contains($item->key, 'image') || str_contains($item->key, 'logo') || str_contains($item->key, 'watermark')) {
                $Models['image'] = public_asset($item->value);
            } else {
                if (! str_contains($item->key, '_ar') || ! str_contains($item->key, '_en')) {
                    $Models[$key] = strip_tags($item->value);
                }
            }
            if (str_contains($item->key, 'address_'.lang())) {
                $Models['address'] = strip_tags($item->value);
            }
            if (str_contains($item->key, 'privacy_'.lang()) || str_contains($item->key, 'about_'.lang()) || str_contains($item->key, 'technical_support_'.lang()) || str_contains($item->key, 'terms_'.lang())) {
                $Models['title'] = strip_tags($item->value);
            }

            unset($Models['privacy_ar']);
            unset($Models['privacy_en']);
            unset($Models['about_ar']);
            unset($Models['about_en']);
            unset($Models['address_ar']);
            unset($Models['address_en']);
            unset($Models['terms_ar']);
            unset($Models['terms_en']);
            unset($Models['technical_support_ar']);
            unset($Models['technical_support_en']);
        }

        return $Models;
    }
}

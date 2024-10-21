<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
            ['key' => 'about_ar', 'value' => '<p>Matjr</p>', 'type' => 'about'],
            ['key' => 'about_en', 'value' => '<p>Matjr</p>', 'type' => 'about'],
            ['key' => 'privacy_ar', 'value' => '<p>Matjr</p>', 'type' => 'privacy'],
            ['key' => 'privacy_en', 'value' => '<p>Matjr</p>', 'type' => 'privacy'],
            ['key' => 'address_ar', 'value' => '<p>Matjr</p>', 'type' => 'address'],
            ['key' => 'address_en', 'value' => '<p>Matjr</p>', 'type' => 'address'],
            ['key' => 'terms_ar', 'value' => '<p>Matjr</p>', 'type' => 'terms'],
            ['key' => 'terms_en', 'value' => '<p>Matjr</p>', 'type' => 'terms'],
            ['key' => 'email', 'value' => 'info@emcan-group.com', 'type' => 'publicSettings'],
            ['key' => 'phone', 'value' => '+97317001092', 'type' => 'publicSettings'],
            ['key' => 'apple', 'value' => 'https://www.apple.com', 'type' => 'publicSettings'],
            ['key' => 'android', 'value' => 'https://www.android.com', 'type' => 'publicSettings'],
            ['key' => 'whatsapp', 'value' => '+97317001092', 'type' => 'publicSettings'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com', 'type' => 'publicSettings'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com', 'type' => 'publicSettings'],
            ['key' => 'twitter', 'value' => 'https://www.twitter.com', 'type' => 'publicSettings'],
            ['key' => 'snapchat', 'value' => 'https://www.snapchat.com', 'type' => 'publicSettings'],
            ['key' => 'behance', 'value' => 'https://www.behance.com', 'type' => 'publicSettings'],
            ['key' => 'pinterest', 'value' => 'https://www.pinterest.com', 'type' => 'publicSettings'],
            ['key' => 'desc', 'value' => '<p>Matjr</p>', 'type' => 'meta'],
            ['key' => 'keywords', 'value' => '<p>Matjr</p>', 'type' => 'meta'],
            ['key' => 'author', 'value' => '<p>Matjr</p>', 'type' => 'meta'],
            ['key' => 'theme', 'value' => 'default-1', 'type' => 'theme'],
            ['key' => 'color', 'value' => '#2eafc6', 'type' => 'themeOption'],
            ['key' => 'font', 'value' => 'Tajawal', 'type' => 'themeOption'],
            ['key' => 'logo', 'value' => '/logo.png', 'type' => 'publicSettings'],
            ['key' => 'progress', 'value' => '1', 'type' => 'progress'],
            ['key' => 'vat', 'value' => '10', 'type' => 'orderDetails'],
            ['key' => 'about_image', 'value' => '', 'type' => 'about'],
        ]);
    }
}

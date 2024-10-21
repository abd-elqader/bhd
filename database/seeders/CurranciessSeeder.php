<?php

namespace Database\Seeders;

use App\Models\Tenant\Currancy;
use Illuminate\Database\Seeder;

class CurranciessSeeder extends Seeder
{
    public function run()
    {
        Currancy::insert([
            ['id' => '1', 'title_ar' => 'دينار بحريني', 'title_en' => 'Bahraini dinar', 'code' => 'BD', 'value' => '1.000', 'image' => 'http://localhost:8000/currancies/BD.jpg', 'default' => '1', 'status' => '1', 'created_at' => '2022-03-17 05:31:11', 'updated_at' => '2022-09-07 12:36:22'],
            ['id' => '2', 'title_ar' => 'ريال سعودي', 'title_en' => 'Saudi riyals', 'code' => 'SAR', 'value' => '9.950', 'image' => 'http://localhost:8000/currancies/SAR.jpg', 'default' => '0', 'status' => '1', 'created_at' => '2022-03-17 05:32:35', 'updated_at' => '2022-09-07 12:48:14'],
            ['id' => '3', 'title_ar' => 'درهم إماراتي', 'title_en' => 'Emirates dirham', 'code' => 'AED', 'value' => '9.740', 'image' => 'http://localhost:8000/currancies/AED.jpg', 'default' => '0', 'status' => '1', 'created_at' => '2022-03-17 05:33:46', 'updated_at' => '2022-09-07 12:48:28'],
            ['id' => '4', 'title_ar' => 'دينار كويتي', 'title_en' => 'Kuwaiti Dinar', 'code' => 'KWD', 'value' => '0.810', 'image' => 'http://localhost:8000/currancies/KWD.jpg', 'default' => '0', 'status' => '1', 'created_at' => '2022-03-17 05:34:21', 'updated_at' => '2022-09-07 12:47:55'],
            ['id' => '5', 'title_ar' => 'ريال عماني', 'title_en' => 'Omani Rial', 'code' => 'OR', 'value' => '1.020', 'image' => 'http://localhost:8000/currancies/OR.jpg', 'default' => '0', 'status' => '1', 'created_at' => '2022-03-17 05:35:34', 'updated_at' => '2022-09-07 12:47:42'],
            ['id' => '6', 'title_ar' => 'دولار أمريكي', 'title_en' => 'American dollar', 'code' => 'USD', 'value' => '2.650', 'image' => 'http://localhost:8000/currancies/USD.jpg', 'default' => '0', 'status' => '1', 'created_at' => '2022-03-17 05:36:07', 'updated_at' => '2022-09-07 12:36:41'],
        ]);
    }
}

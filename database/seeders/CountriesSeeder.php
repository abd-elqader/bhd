<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        Country::insert([
            ['id' => '1', 'title_ar' => 'البحرين', 'title_en' => 'Bahrain', 'country_code' => 'BH', 'phone_code' => '973', 'lat' => '25.93041400', 'long' => '50.63777200', 'status' => '1', 'image' => '/countries/Bahrain.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '2', 'title_ar' => 'المملكة العربية السعودية', 'title_en' => 'Saudi Arabia', 'country_code' => 'SA', 'phone_code' => '966', 'lat' => '23.88594200', 'long' => '45.07916200', 'status' => '1', 'image' => '/countries/SaudiArabia.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '3', 'title_ar' => 'سلطنة عمان', 'title_en' => 'Oman', 'country_code' => 'OM', 'phone_code' => '968', 'lat' => '21.51258300', 'long' => '55.92325500', 'status' => '1', 'image' => '/countries/Oman.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '4', 'title_ar' => 'الإمارات العربية المتحدة', 'title_en' => 'United Arab Emirates', 'country_code' => 'AE', 'phone_code' => '971', 'lat' => '23.42407600', 'long' => '53.84781800', 'status' => '1', 'image' => '/countries/UnitedArabEmirates.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '5', 'title_ar' => 'قطر', 'title_en' => 'Qatar', 'country_code' => 'QA', 'phone_code' => '974', 'lat' => '25.35482600', 'long' => '51.18388400', 'status' => '1', 'image' => '/countries/Kuwait.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '6', 'title_ar' => 'الكويت', 'title_en' => 'Kuwait', 'country_code' => 'KW', 'phone_code' => '965', 'lat' => '29.31166000', 'long' => '47.48176600', 'status' => '1', 'image' => '/countries/Kuwait.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
            ['id' => '7', 'title_ar' => 'مصر', 'title_en' => 'Egypt', 'country_code' => 'EG', 'phone_code' => '20', 'lat' => '26.82055300', 'long' => '30.80249800', 'status' => '1', 'image' => '/countries/Egypt.png', 'created_at' => '2022-09-05 11:17:45', 'updated_at' => '2022-09-05 11:17:45'],
        ]);
    }
}

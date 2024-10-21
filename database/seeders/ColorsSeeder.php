<?php

namespace Database\Seeders;

use App\Models\Tenant\Color;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    public function run()
    {
        Color::insert([
            [
                'title_ar' => 'أحمر',
                'title_en' => 'Red',
                'hexa' => '#ff0000',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:33',
            ],
            [
                'title_ar' => 'أصفر',
                'title_en' => 'Yellow',
                'hexa' => '#fbe80e',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:39',
            ],
            [
                'title_ar' => 'أخضر',
                'title_en' => 'Green',
                'hexa' => '#40f000',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:41',
            ],
            [
                'title_ar' => 'أزرق',
                'title_en' => 'Blue',
                'hexa' => '#2206b2',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:44',
            ],
            [
                'title_ar' => 'نيلى',
                'title_en' => 'Indigo',
                'hexa' => '#4B0082',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:46',
            ],
            [
                'title_ar' => 'بنفسجى',
                'title_en' => 'Violet',
                'hexa' => '#8F00FF',
                'status' => '1',
                'created_at' => '2021-06-07 10:22:08',
                'updated_at' => '2022-03-04 20:36:52',
            ],
            [
                'title_ar' => 'الزيتي',
                'title_en' => 'Dark green',
                'hexa' => '#013220 ',
                'status' => '1',
                'created_at' => '2021-06-14 17:33:35',
                'updated_at' => '2022-03-04 20:36:50',
            ],
            [
                'title_ar' => 'أسود',
                'title_en' => 'Black',
                'hexa' => '#000',
                'status' => '1',
                'created_at' => '2021-06-14 17:33:57',
                'updated_at' => '2022-03-04 20:36:56',
            ],
            [
                'title_ar' => 'أبيض',
                'title_en' => 'White',
                'hexa' => '#ffffff',
                'status' => '1',
                'created_at' => '2021-06-14 17:34:18',
                'updated_at' => '2022-03-04 20:36:54',
            ],
            [
                'title_ar' => 'سماوي',
                'title_en' => 'Light blue',
                'hexa' => '#ADD8E6',
                'status' => '1',
                'created_at' => '2021-06-14 17:34:47',
                'updated_at' => '2022-03-04 20:37:08',
            ],
            [
                'title_ar' => 'وردي',
                'title_en' => 'Pink',
                'hexa' => '#FFC0CB ',
                'status' => '1',
                'created_at' => '2021-06-15 06:38:41',
                'updated_at' => '2022-03-04 20:37:07',
            ],
            [
                'title_ar' => 'ماروني',
                'title_en' => 'Maroon',
                'hexa' => '#800000',
                'status' => '1',
                'created_at' => '2021-06-15 08:20:03',
                'updated_at' => '2022-03-04 20:37:04',
            ],
            [
                'title_ar' => 'بيج',
                'title_en' => 'Node',
                'hexa' => '#215732',
                'status' => '1',
                'created_at' => '2021-06-15 09:27:35',
                'updated_at' => '2022-03-04 20:37:02',
            ],
            [
                'title_ar' => 'بني',
                'title_en' => 'Brown',
                'hexa' => '#964B00',
                'status' => '1',
                'created_at' => '2021-06-15 10:25:03',
                'updated_at' => '2022-08-15 12:54:24
            ', ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ImageType;
use Illuminate\Database\Seeder;

class ImageTypeSeeder extends Seeder
{
    public function run()
    {
        ImageType::insert([
            ['id' => '1', 'title_ar' => 'اراء العملاء', 'title_en' => 'Testimonials', 'created_at' => '2022-08-23 11:53:38', 'updated_at' => '2022-08-23 11:56:05'],
            ['id' => '2', 'title_ar' => 'خدمات', 'title_en' => 'Services', 'created_at' => '2022-08-23 11:53:50', 'updated_at' => '2022-08-23 11:53:50'],
            ['id' => '3', 'title_ar' => 'لماذا متجر؟!', 'title_en' => 'Why Matjr?!', 'created_at' => '2022-08-23 11:54:32', 'updated_at' => '2022-08-23 11:54:32'],
            ['id' => '5', 'title_ar' => 'سلايدر', 'title_en' => 'Slider', 'created_at' => '2022-09-11 06:33:38', 'updated_at' => '2022-09-11 06:33:38'],
            ['id' => '6', 'title_ar' => 'إحصائيات', 'title_en' => 'Statistics', 'created_at' => '2022-09-11 08:43:22', 'updated_at' => '2022-09-11 08:43:22'],
            ['id' => '7', 'title_ar' => 'عملائنا', 'title_en' => 'Our Clients', 'created_at' => '2022-09-12 07:13:06', 'updated_at' => '2022-09-12 07:13:06'],
            ['id' => '8', 'title_ar' => 'شهادات تسجيل الدخول', 'title_en' => 'login Testimonials', 'created_at' => '2022-09-12 12:58:55', 'updated_at' => '2022-09-12 12:58:55'],
        ]);
    }
}

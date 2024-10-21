<?php

namespace Database\Seeders;

use App\Models\Tenant\Size;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    public function run()
    {
        Size::insert([
            [
                'title_ar' => '0-3 شهور',
                'title_en' => '0-3 MONTHS',
                'status' => '1',
                'created_at' => '2022-01-28 11:00:54',
                'updated_at' => '2022-01-28 11:00:54',
            ],
            [
                'title_ar' => '3-6 شهور',
                'title_en' => '3-6 MONTHS',
                'status' => '1',
                'created_at' => '2022-01-28 11:01:18',
                'updated_at' => '2022-03-04 20:41:28',
            ],
            [
                'title_ar' => '6-9 شهور',
                'title_en' => '6-9 MONTHS',
                'status' => '1',
                'created_at' => '2022-03-04 20:40:45',
                'updated_at' => '2022-03-04 20:40:45',
            ],
            [
                'title_ar' => '9-12 شهر',
                'title_en' => '9-12 MONTHS',
                'status' => '1',
                'created_at' => '2022-03-04 20:41:59',
                'updated_at' => '2022-03-04 20:41:59',
            ],
            [
                'title_ar' => '12-18 شهر',
                'title_en' => '12-18 MONTHS',
                'status' => '1',
                'created_at' => '2022-03-04 20:42:33',
                'updated_at' => '2022-03-04 20:42:33',
            ],
            [
                'title_ar' => '12-24 شهر',
                'title_en' => '12-24 MONTHS',
                'status' => '1',
                'created_at' => '2022-03-04 20:42:54',
                'updated_at' => '2022-03-04 20:42:54',
            ],
            [
                'title_ar' => '2-3 سنوات',
                'title_en' => '2-3 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:43:13',
                'updated_at' => '2022-03-04 20:43:13',
            ],
            [
                'title_ar' => '3-4 سنوات',
                'title_en' => '3-4 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:43:26',
                'updated_at' => '2022-03-04 20:43:26',
            ],
            [
                'title_ar' => '4-5 سنوات',
                'title_en' => '4-5 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:43:46',
                'updated_at' => '2022-03-04 20:43:46',
            ],
            [
                'title_ar' => '5-6 سنوات',
                'title_en' => '5-6 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:44:07',
                'updated_at' => '2022-03-04 20:44:39',
            ],
            [
                'title_ar' => '6-7 سنوات',
                'title_en' => '6-7 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:45:08',
                'updated_at' => '2022-03-04 20:45:08',
            ],
            [
                'title_ar' => '7-8 سنوات',
                'title_en' => '7-8 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:45:24',
                'updated_at' => '2022-03-04 20:45:24',
            ],
            [
                'title_ar' => '8-9 سنوات',
                'title_en' => '8-9 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:45:49',
                'updated_at' => '2022-03-04 20:45:49',
            ],
            [
                'title_ar' => '9-10 سنوات',
                'title_en' => '9-10 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:46:07',
                'updated_at' => '2022-03-04 20:46:07',
            ],
            [
                'title_ar' => '10-11 سنة',
                'title_en' => '10-11 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:46:40',
                'updated_at' => '2022-03-04 20:46:40',
            ],
            [
                'title_ar' => '11-12 سنة',
                'title_en' => '11-12 YEARS',
                'status' => '1',
                'created_at' => '2022-03-04 20:46:58',
                'updated_at' => '2022-03-04 20:46:58',
            ],
            [
                'title_ar' => '18-24 شهر',
                'title_en' => '18-24 MONTHS',
                'status' => '1',
                'created_at' => '2022-03-04 23:03:05',
                'updated_at' => '2022-03-04 23:03:05',
            ],
            [
                'title_ar' => '35.1x35.1 إنج',
                'title_en' => '35.1x35.1 Inch',
                'status' => '1',
                'created_at' => '2022-03-11 11:17:34',
                'updated_at' => '2022-03-11 11:17:34', ],
        ]);
    }
}

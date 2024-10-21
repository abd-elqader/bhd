<?php

namespace Database\Seeders;

use App\Models\Tenant\Delivry;
use Illuminate\Database\Seeder;

class DelivriesSeeder extends Seeder
{
    public function run()
    {
        Delivry::insert([
            [
                'title_ar' => 'توصيل إلى المنزل',
                'title_en' => 'Delivery',
                'status' => '1',
                'created_at' => '2022-08-23 14:36:08',
                'updated_at' => '2022-08-23 14:36:08',
            ],
            [
                'title_ar' => 'إستلام من  المحل',
                'title_en' => 'Pick Up',
                'status' => '1',
                'created_at' => '2022-08-23 14:36:28',
                'updated_at' => '2022-08-23 14:36:28',
            ],
            [
                'title_ar' => 'داخل المطعم',
                'title_en' => 'Dine In',
                'status' => '1',
                'created_at' => '2022-08-23 14:36:41',
                'updated_at' => '2022-08-23 14:36:41',
            ],
        ]);
    }
}

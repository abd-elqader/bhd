<?php

namespace Database\Seeders;

use App\Models\Tenant\OfferType;
use Illuminate\Database\Seeder;

class OfferTypesSeeder extends Seeder
{
    public function run()
    {
        OfferType::insert([
            [
                'title_ar' => 'اذا اشترى العميل X يحصل على Y',
                'title_en' => 'If the customer buys X, he gets Y',
                'status' => '1',
                'created_at' => '2022-08-31 08:35:02',
                'updated_at' => '2022-08-31 08:35:02',
            ],
            [
                'title_ar' => 'مبلغ ثابت من قيمة مشتريات العميل',
                'title_en' => 'A fixed amount of the value of the customer\'s purchases',
                'status' => '1',
                'created_at' => '2022-08-31 08:35:14',
                'updated_at' => '2022-08-31 08:35:14',
            ],
            [
                'title_ar' => 'نسبة من قيمة مشتريات العميل',
                'title_en' => 'Percentage of the value of the customer\'s purchases',
                'status' => '1',
                'created_at' => '2022-08-31 08:35:28',
                'updated_at' => '2022-08-31 08:35:28',
            ],
        ]);
    }
}

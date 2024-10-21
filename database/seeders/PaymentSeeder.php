<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::insert([
            [
                'title_ar' => 'الدفع عند الاستلام',
                'title_en' => 'Cash On Delivery',
            ],
        ]);
    }
}

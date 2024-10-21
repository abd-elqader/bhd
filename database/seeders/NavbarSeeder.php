<?php

namespace Database\Seeders;

use App\Models\Navbar;
use Illuminate\Database\Seeder;

class NavbarSeeder extends Seeder
{
    public function run()
    {
        Navbar::insert([
            ['title_en' => 'Home', 'title_ar' => 'الرئيسية', 'path' => 'Home'],
            ['title_en' => 'Products', 'title_ar' => 'المنتجات', 'path' => 'Product'],
            ['title_en' => 'Categoris', 'title_ar' => 'الاقسام', 'path' => 'Category'],
            ['title_en' => 'Profile', 'title_ar' => 'الصفحة الشخصية', 'path' => 'Profile'],
            ['title_en' => 'About Us', 'title_ar' => 'عن الموقع', 'path' => 'About'],
            ['title_en' => 'Contact Us', 'title_ar' => 'تواصل معنا', 'path' => 'Contact'],
            ['title_en' => 'Branches', 'title_ar' => 'الفروع', 'path' => 'Branch'],
            ['title_en' => 'Cart', 'title_ar' => 'العربة', 'path' => 'Cart'],
        ]);
    }
}

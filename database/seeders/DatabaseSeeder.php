<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $data = Session::get('data');
        $Admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'country_code' => $data['country_code'],
            'phone_code' => $data['phone_code'],
        ]);
        $Admin->assignRole(1);
        Session::forget('data');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = Session::get('data');
        $role_id = Role::first()->id;
        if ($data) {
            $Admin = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'country_code' => $data['country_code'],
                'phone_code' => $data['phone_code'],
            ]);
            $Admin->assignRole($role_id);
            Session::forget('data');
        } else {
            $Admin = Admin::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'phone' => '123456',
                'password' => Hash::make('123456'),
                'country_code' => 'BH',
                'phone_code' => '973',
            ]);
            $Admin->assignRole($role_id);
        }
    }
}

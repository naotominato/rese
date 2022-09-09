<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => '管理 直人',
                'email' => 'admin1@example.com',
                'password' => Hash::make('aaaaaaaa'),
            ],
        ];

        foreach($admins as $admin) {
            Admin::create($admin);
        }
    }
}

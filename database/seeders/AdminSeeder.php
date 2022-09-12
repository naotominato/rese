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
                'name' => 'Rese管理者',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach($admins as $admin) {
            Admin::create($admin);
        }
    }
}

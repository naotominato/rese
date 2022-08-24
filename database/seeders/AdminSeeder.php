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
        //後から追加できるように繰り返し文で記述しております。
        $admins = [
            [
                'name' => '管理 直人',
                'email' => 'na-a.a55d-h@ymail.ne.jp',
                'password' => Hash::make('aaaaaaaa'),
            ],
        ];

        foreach($admins as $admin) {
            Admin::create($admin);
        }
    }
}

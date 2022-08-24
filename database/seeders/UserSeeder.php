<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //後から追加できるように繰り返し文で記述しております。
        $users = [
            [
                'name' => '阿曽 直人',
                'email' => 'na-a.a55d-h@ymail.ne.jp',
                'email_verified_at' => '2022-08-22 16:03:17',
                'password' => Hash::make('aaaaaaaa'),
            ],
            [
                'name' => 'あそ　なおと',
                'email_verified_at' => '2022-08-22 16:20:32',
                'email' => 'na-a.a55d-h@yahoo.ne.jp',
                'password' => Hash::make('aaaaaaaa'),
            ],
            [
                'name' => 'アソ　ナオト',
                'email_verified_at' => '2022-08-23 16:20:32',
                'email' => 'na-a.a55d-h@docomo.ne.jp',
                'password' => Hash::make('aaaaaaaa'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

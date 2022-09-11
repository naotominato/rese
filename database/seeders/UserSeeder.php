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
        $users = [
            [
                'name' => '直人 直人',
                'email' => 'user1@example.com',
                'email_verified_at' => '2022-08-22 16:03:17',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'なおと なおと',
                'email_verified_at' => '2022-08-22 16:20:32',
                'email' => 'user2@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'ナオト ナオト',
                'email_verified_at' => '2022-08-23 16:20:32',
                'email' => 'user3@example.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

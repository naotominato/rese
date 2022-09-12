<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = [
            [
                'name' => 'テスト代表1',
                'shop_id' => 1,
                'email' => 'manager1@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'テスト代表2',
                'shop_id' => 2,
                'email' => 'manager2@example.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($managers as $manager) {
            Manager::create($manager);
        }
    }
}

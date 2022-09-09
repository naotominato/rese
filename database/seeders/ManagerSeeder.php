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
                'name' => '店代 直人',
                'shop_id' => 1,
                'email' => 'manager1@example.com',
                'password' => Hash::make('aaaaaaaa'),
            ],
            [
                'name' => '店代二 直人',
                'shop_id' => 2,
                'email' => 'manager2@example.com',
                'password' => Hash::make('aaaaaaaa'),
            ],
        ];

        foreach ($managers as $manager) {
            Manager::create($manager);
        }
    }
}

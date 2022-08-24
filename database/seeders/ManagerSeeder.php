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
        //後から追加できるように繰り返し文で記述しております。
        $managers = [
            [
                'name' => '店代 直人',
                'shop_id' => 1,
                'email' => 'na-a.a55d-h@ymail.ne.jp',
                'password' => Hash::make('aaaaaaaa'),
            ],
            [
                'name' => '店代二 直人',
                'shop_id' => 2,
                'email' => 'na-a.a55d-h@yahoo.ne.jp',
                'password' => Hash::make('aaaaaaaa'),
            ],
        ];

        foreach ($managers as $manager) {
            Manager::create($manager);
        }
    }
}

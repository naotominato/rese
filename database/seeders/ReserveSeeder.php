<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserve;

class ReserveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reserves = [
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-08-27 11:30:00',
                'number' => 2,
            ],
            [
                'user_id' => 1,
                'shop_id' => 3,
                'start' => '2022-08-29 13:00:00',
                'number' => 4,
            ],
            [
                'user_id' => 1,
                'shop_id' => 2,
                'start' => '2022-09-07 13:00:00',
                'number' => 3,
            ],
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-09-07 19:00:00',
                'number' => 3,
            ],
            [
                'user_id' => 1,
                'shop_id' => 3,
                'start' => '2022-09-21 20:00:00',
                'number' => 2,
            ],
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-09-18 13:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 1,
                'shop_id' => 2,
                'start' => '2022-09-25 20:00:00',
                'number' => 2,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
                'start' => '2022-09-07 11:00:00',
                'number' => 10,
            ],
            [
                'user_id' => 2,
                'shop_id' => 5,
                'start' => '2022-09-07 16:00:00',
                'number' => 10,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
                'start' => '2022-09-23 15:00:00',
                'number' => 8,
            ], 
            [
                'user_id' => 3,
                'shop_id' => 4,
                'start' => '2022-09-07 12:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 3,
                'shop_id' => 1,
                'start' => '2022-09-18 12:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 3,
                'shop_id' => 1,
                'start' => '2022-09-01 12:00:00',
                'number' => 7,
            ],
        ];

        foreach ($reserves as $reserve) {
            Reserve::create($reserve);
        }
    }
}

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
                'shop_id' => 2,
                'start' => '2022-09-10 10:00:00',
                'number' => 4,
            ],
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-09-10 23:00:00',
                'number' => 4,
            ],
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-09-13 10:00:00',
                'number' => 2,
            ],
            [
                'user_id' => 1,
                'shop_id' => 2,
                'start' => '2022-09-13 15:00:00',
                'number' => 2,
            ],
            [
                'user_id' => 1,
                'shop_id' => 2,
                'start' => '2022-09-13 23:00:00',
                'number' => 3,
            ],
            [
                'user_id' => 1,
                'shop_id' => 2,
                'start' => '2022-09-14 21:00:00',
                'number' => 2,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
                'start' => '2022-09-12 11:00:00',
                'number' => 10,
            ],
            [
                'user_id' => 2,
                'shop_id' => 2,
                'start' => '2022-09-13 16:00:00',
                'number' => 10,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
                'start' => '2022-09-14 16:00:00',
                'number' => 10,
            ],
            [
                'user_id' => 3,
                'shop_id' => 1,
                'start' => '2022-09-12 12:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 3,
                'shop_id' => 2,
                'start' => '2022-09-13 12:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 3,
                'shop_id' => 1,
                'start' => '2022-09-14 12:00:00',
                'number' => 5,
            ],
        ];

        foreach ($reserves as $reserve) {
            Reserve::create($reserve);
        }
    }
}

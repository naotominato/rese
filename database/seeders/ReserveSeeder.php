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
                'start' => '2022-09-04 11:30:00',
                'number' => 3,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
                'start' => '2022-08-30 15:00:00',
                'number' => 10,
            ], [
                'user_id' => 3,
                'shop_id' => 1,
                'start' => '2022-09-01 12:00:00',
                'number' => 5,
            ],
            [
                'user_id' => 1,
                'shop_id' => 1,
                'start' => '2022-09-18 13:00:00',
                'number' => 3,
            ],
        ];

        foreach ($reserves as $reserve) {
            Reserve::create($reserve);
        }
    }
}

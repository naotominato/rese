<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [
            [
                'user_id' => 1,
                'shop_id' => 1,
            ],
            [
                'user_id' => 2,
                'shop_id' => 1,
            ],
            [
                'user_id' => 3,
                'shop_id' => 1,
            ],
        ];

        foreach ($favorites as $favorite) {
            Favorite::create($favorite);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AreaSeeder::class,
            GenreSeeder::class,
            ShopSeeder::class,
            ReserveSeeder::class,
            FavoriteSeeder::class,
            AdminSeeder::class,
            ManagerSeeder::class,
        ]);
    }
}

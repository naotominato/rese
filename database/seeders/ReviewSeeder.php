<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'reserve_id' => 1,
                'evaluation' => 4,
                'comment' => '美味しかったです！！',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}

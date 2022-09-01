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
                'comment' => 'user_idが1のユーザーで、評価は4です。予約idはuniqueなので、被りません。',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}

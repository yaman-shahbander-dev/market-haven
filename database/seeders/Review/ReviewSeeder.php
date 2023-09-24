<?php

namespace Database\Seeders\Review;

use Database\Factories\Review\ReviewFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('reviews')->truncate();
        ReviewFactory::new()->count(10)->create();
    }
}

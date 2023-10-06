<?php

namespace Database\Seeders\Favorite;

use Database\Factories\Favorite\FavoriteFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('favorites')->truncate();
        FavoriteFactory::new()->count(10)->create();
    }
}

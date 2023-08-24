<?php

namespace Database\Seeders\Location;

use Database\Factories\Location\ContinentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('continents')->truncate();
        ContinentFactory::new()->count(7)->create();
    }
}

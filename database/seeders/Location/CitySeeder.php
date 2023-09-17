<?php

namespace Database\Seeders\Location;

use Database\Factories\Location\CityFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('cities')->truncate();
        CityFactory::new()->count(300)->create();
    }
}

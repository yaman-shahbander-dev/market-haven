<?php

namespace Database\Seeders\Location;

use Database\Factories\Location\CountryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('countries')->truncate();
        CountryFactory::new()->count(100)->create();
    }
}

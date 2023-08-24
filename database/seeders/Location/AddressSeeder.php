<?php

namespace Database\Seeders\Location;

use Database\Factories\Location\AddressFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('addresses')->truncate();
        AddressFactory::new()->count(100)->create();
    }
}

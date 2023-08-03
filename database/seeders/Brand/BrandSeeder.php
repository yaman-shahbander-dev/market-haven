<?php

namespace Database\Seeders\Brand;

use Database\Factories\Brand\BrandFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('brands')->truncate();
        BrandFactory::new()->count(10)->create();
    }
}

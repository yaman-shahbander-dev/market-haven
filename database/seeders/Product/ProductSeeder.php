<?php

namespace Database\Seeders\Product;

use Database\Factories\Product\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('products')->truncate();
        ProductFactory::new()->count(10)->create();
    }
}

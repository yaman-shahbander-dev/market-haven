<?php

namespace Database\Seeders\Product;

use Database\Factories\Product\ProductDetailsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('product_details')->truncate();
        ProductDetailsFactory::new()->count(10)->create();
    }
}

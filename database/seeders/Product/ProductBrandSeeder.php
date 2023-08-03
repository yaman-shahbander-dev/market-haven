<?php

namespace Database\Seeders\Product;

use Database\Factories\Product\ProductBrandFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('product_brand')->truncate();
        ProductBrandFactory::new()->count(10)->create();
    }
}

<?php

namespace Database\Seeders\Product;

use Database\Factories\Product\ProductCategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('product_category')->truncate();
        ProductCategoryFactory::new()->count(10)->create();
    }
}

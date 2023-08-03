<?php

namespace Database\Seeders\Product;

use Database\Factories\Product\ProductColorsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('product_colors')->truncate();
        ProductColorsFactory::new()->count(10)->create();
    }
}

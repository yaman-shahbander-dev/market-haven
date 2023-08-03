<?php

namespace Database\Seeders\Cart;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\Cart\CartFactory;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('carts')->truncate();
        CartFactory::new()->count(10)->create();
    }
}

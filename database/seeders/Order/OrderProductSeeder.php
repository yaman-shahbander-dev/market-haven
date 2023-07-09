<?php

namespace Database\Seeders\Order;

use Database\Factories\Order\OrderProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('order_product')->truncate();
        OrderProductFactory::new()->count(5)->create();
    }
}

<?php

namespace Database\Seeders\Order;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\Order\OrderFactory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('orders')->truncate();
        OrderFactory::new()->count(5)->create();
    }
}

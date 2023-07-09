<?php

namespace Database\Seeders\Cart;

use Database\Factories\Cart\CartFactory;
use Database\Factories\Product\ProductDetailsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('cart_product')->truncate();
        $cart = CartFactory::new()->create();
        $products = ProductDetailsFactory::new()->count(5)->create();
        $data = [];
        for ($i = 0; $i < count($products); $i++) {
            $data[$i]['id'] = Str::orderedUuid()->toString();
            $data[$i]['product_id'] = $products[$i]['id'];
            $data[$i]['cart_id'] = $cart->id;
            $data[$i]['price'] = $products[$i]['price'];
            $data[$i]['quantity'] = $products[$i]['quantity'];
        }
        DB::table('cart_product')->insert($data);
    }
}

<?php

namespace Database\Factories\Cart;

use Domain\Cart\Models\CartProduct;
use Domain\Product\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Product\Models\Product;
use Database\Factories\Product\ProductFactory;
use Domain\Cart\Models\Cart;
use Database\Factories\Cart\CartFactory;
use Database\Factories\Product\ProductColorsFactory;

class CartProductFactory extends Factory
{
    protected $model = CartProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'product_id' => (
                Product::query()->first() ??
                ProductFactory::new()->create()
            )->id,
            'product_color_id' => (
                ProductColor::query()->first() ??
                ProductColorsFactory::new()->create()
            )->id,
            'cart_id' => (
                Cart::query()->first() ??
                CartFactory::new()->create()
            )->id,
            'quantity' => fake()->randomDigitNotZero(),
            'price' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

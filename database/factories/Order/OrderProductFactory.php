<?php

namespace Database\Factories\Order;

use Domain\Order\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Product\Models\Product;
use Database\Factories\Product\ProductFactory;
use Domain\Order\Models\Order;

class OrderProductFactory extends Factory
{
    protected $model = OrderProduct::class;

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
            'order_id' => (
                Order::query()->first() ??
                OrderFactory::new()->create()
            )->id,
            'quantity' => fake()->randomDigitNotZero(),
            'price' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

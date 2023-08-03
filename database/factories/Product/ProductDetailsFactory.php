<?php

namespace Database\Factories\Product;

use Domain\Product\Models\Product;
use Domain\Product\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailsFactory extends Factory
{
    protected $model = ProductDetail::class;
    protected $product = Product::class;

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
                $this->product::query()->inRandomOrder()->first() ?? $this->product->new()->create()
            )->id,
            'price' => fake()->randomFloat(2, 0, 10000),
            'discount' => fake()->randomFloat(2, 0, 10000),
            'quantity' => fake()->randomDigitNotZero(),
            'available' => fake()->boolean(100),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

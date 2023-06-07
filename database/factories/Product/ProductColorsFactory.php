<?php

namespace Database\Factories\Product;

use Domain\Product\Models\ProductColor;
use Domain\Product\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductColorsFactory extends Factory
{
    protected $model = ProductColor::class;
    protected $productDetail = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'product_detail_id' => (
                $this->productDetail::query()->inRandomOrder()->first() ?? $this->productDetail->new()->create()
            )->id,
            'color' => fake()->colorName(),
            'quantity' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

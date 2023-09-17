<?php

namespace Database\Factories\Product;

use Domain\Brand\Models\Brand;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBrandFactory extends Factory
{
    protected $model = ProductBrand::class;
    protected $product = Product::class;
    protected $brand = Brand::class;

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
            'brand_id' => (
                $this->brand::query()->inRandomOrder()->first() ?? $this->brand->new()->create()
            )->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

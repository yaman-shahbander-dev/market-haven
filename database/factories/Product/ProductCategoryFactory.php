<?php

namespace Database\Factories\Product;

use Domain\Category\Models\Category;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;
    protected $product = Product::class;
    protected $category = Category::class;

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
            'category_id' => (
                $this->category::query()->inRandomOrder()->first() ?? $this->category->new()->create()
            )->id,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

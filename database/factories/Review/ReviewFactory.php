<?php

namespace Database\Factories\Review;

use Domain\Product\Models\Product;
use Domain\Client\Models\User;
use Database\Factories\Product\ProductFactory;
use Database\Factories\Client\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Review\Models\Review;
use Shared\Enums\MorphEnum;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productId = (
            Product::query()->first() ??
            ProductFactory::new()->create()
        )->id;

        $userId = (
            User::query()->first() ??
            UserFactory::new()->create()
        )->id;

        return [
            'id' => fake()->uuid(),
            'reviewable_type' => MorphEnum::PRODUCT->value,
            'reviewable_id' => $productId,
            'user_id' => $userId,
            'rating' => fake()->numberBetween(1, 5),
            'review' => fake()->sentence(),
            'approved_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

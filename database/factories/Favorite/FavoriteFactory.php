<?php

namespace Database\Factories\Favorite;

use Database\Factories\Client\UserFactory;
use Database\Factories\Product\ProductFactory;
use Domain\Client\Models\User;
use Domain\Favorite\Models\Favorite;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Enums\MorphEnum;


class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = (
            User::query()->first()
            ?? UserFactory::new()->create()
        )->id;

        $productId = (
            Product::query()->first()
            ?? ProductFactory::new()->create()
        )->id;

        return [
            'id' => fake()->uuid(),
            'user_id' => $userId,
            'favorable_type' => MorphEnum::PRODUCT->value,
            'favorable_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

<?php

namespace Database\Factories\Cart;

use Domain\Cart\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Client\Models\User;
use Database\Factories\Client\UserFactory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'user_id' => (
                User::query()->first() ??
                UserFactory::new()->create()
            )->id,
            'name' => fake()->unique()->word(),
            'quantity' => fake()->randomDigitNotZero(),
            'price' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

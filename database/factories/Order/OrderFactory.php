<?php

namespace Database\Factories\Order;

use Domain\Order\Models\Order;
use Domain\Order\States\Pending;
use Domain\Payment\Enums\PaymentGatewayEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Client\Models\User;
use Database\Factories\Client\UserFactory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'no' => $this->faker->unique()->numberBetween(1, 1000),
            'user_id' => (
                User::query()->first() ??
                UserFactory::new()->create()
            )->id,
            'first_name' => fake()->word(),
            'last_name' => fake()->word(),
            'email' => fake()->email(),
            'payment_gateway' => $this->faker->randomElement(PaymentGatewayEnum::getValues()),
            'price' => $this->faker->numerify('#'),
            'state' => Pending::getMorphClass(),
            'expired_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

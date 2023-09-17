<?php

namespace Database\Factories\Location;

use Database\Factories\Order\OrderFactory;
use Domain\Location\Models\Address;
use Domain\Location\Models\City;
use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected CityFactory $cityFactory;
    protected OrderFactory $orderFactory;

    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'city_id' => (
                $this->cityFactory ??
                City::query()->first()
            )->id,
            'order_id' => (
                $this->orderFactory ??
                Order::query()->first()
            )->id,
            'address' => $this->faker->address(),
            'postal_code' => $this->faker->postcode(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

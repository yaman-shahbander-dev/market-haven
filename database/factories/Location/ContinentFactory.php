<?php

namespace Database\Factories\Location;

use Domain\Location\Models\Continent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContinentFactory extends Factory
{
    protected $model = Continent::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(3),
            'name' => $this->faker->text(16),
            'code' => 'co',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

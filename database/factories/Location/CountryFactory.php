<?php

namespace Database\Factories\Location;

use Domain\Location\Models\Continent;
use Domain\Location\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected ContinentFactory $continentFactory;

    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(3),
            'continent_id' => (
                $this->continentFactory ??
                Continent::query()->first()
            )->id,
            'name' => $this->faker->city(),
            'full_name' => null,
            'capital' => null,
            'code_alpha3' => null,
            'code' => null,
            'emoji' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

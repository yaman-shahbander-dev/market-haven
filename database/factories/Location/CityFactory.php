<?php

namespace Database\Factories\Location;

use Domain\Location\Models\City;
use Domain\Location\Models\Continent;
use Domain\Location\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected CountryFactory $countryFactory;

    protected $model = City::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(3),
            'country_id' => (
                $this->countryFactory ??
                Country::query()->first()
            )->id,
            'name' => $this->faker->city(),
            'full_name' => null,
            'code' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

<?php

namespace Database\Factories\Brand;

use Domain\Brand\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;


class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}

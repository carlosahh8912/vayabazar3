<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(),
            'cost' => $this->faker->randomFloat(2,100,250),
            'price' => $this->faker->randomFloat(2,350,950),
            'stock' => 1,
            'purchased' => $this->faker->date(),
            'brand_id' => $this->faker->numberBetween(1,15),
            // 'status' => $this->faker->randomElements(['available', 'unavailable', 'sold', 'removed']),
        ];
    }
}

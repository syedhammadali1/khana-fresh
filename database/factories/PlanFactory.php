<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'limit' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->numberBetween(1,200)

        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->name(),
            'limit' => $this->faker->numberBetween(1, 20),
            'price' => $this->faker->numberBetween(1, 200)
        ];
    }
}

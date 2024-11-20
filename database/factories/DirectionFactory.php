<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DirectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           "code_direction" => $this->faker->companySuffix,
           "lib_direction" => $this->faker->company,
        ];
    }
}

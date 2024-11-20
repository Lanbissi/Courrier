<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FonctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code_fonction" => $this->faker->jobTitle,
            "lib_fonction" => $this->faker->jobTitle,
            "direction_id" => rand(1,4)
        ];
    }
}

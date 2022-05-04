<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class unitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unitName' => $this->faker->text,
            'unitCode' => $this->faker->randomNumber(4),
        ];
    }
}

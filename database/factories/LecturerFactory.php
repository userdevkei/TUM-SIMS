<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'staffNumber' => $this->faker->randomNumber(5),
            'lecturerName' => $this->faker->name,
            'lecturerPhone' => $this->faker->phoneNumber,
            'lecturerEmail' => $this->faker->email

        ];
    }
}

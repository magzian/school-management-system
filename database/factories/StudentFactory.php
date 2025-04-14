<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'reg_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'dob' => $this->faker->dateTimeBetween('-20 years', '-10 years'),
            'parent_number' => $this->faker->numerify('##########'),
            'parent_email' => $this->faker->safeEmail(),
            'image_path' => null,
        ];
    }
}

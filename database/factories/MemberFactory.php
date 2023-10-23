<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author' => 1,
            'name' => $this->faker->name(),
            'family' => $this->faker->lastName(),
            'mobile' => $this->faker->phoneNumber(),
            'status' => 'bronze',
            'emotional' => $this->faker->numberBetween('1', '10'),
            'work' => $this->faker->numberBetween('1', '10'),
            'consult_ability' => $this->faker->numberBetween('1', '10'),
            'success' => $this->faker->numberBetween('1', '10'),
            'intimacy' => $this->faker->numberBetween('1', '10'),
            'age' => $this->faker->numberBetween('1', '10'),
            'motivation' => $this->faker->numberBetween('1', '10'),
            'free_time' => $this->faker->numberBetween('1', '10'),
            'marital_status' => $this->faker->numberBetween('1', '10'),
            'experience' => $this->faker->numberBetween('1', '10'),
            'meets' => $this->faker->numberBetween('1', '10'),
        ];
    }
}

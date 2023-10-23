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
            'mobile' => $this->faker->phoneNumber(),
            'status' => 'bronze',
            'point_1' => $this->faker->numberBetween('1', '100'),
            'point_2' => $this->faker->numberBetween('1', '100'),
        ];
    }
}

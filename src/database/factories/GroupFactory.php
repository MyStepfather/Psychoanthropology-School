<?php

namespace Database\Factories;

use App\Constants\GroupTypes;
use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $town = Town::inRandomOrder()->first();

        return [
            //            'type' => GroupTypes::ALL[array_rand(GroupTypes::ALL)],
            'type' => ['read', 'work'][array_rand(['read', 'work'])],
            'coordinator_user_id' => fake()->numberBetween(1, 20),
            'town_id' => $town->id,
            'country_id' => $town->country_id,
            'weekday' => random_int(1, 5),
            'time' => '11:30',
            'place' => 'м. Китай город, Покровка 27 Центр «Самадева»',
        ];
    }
}

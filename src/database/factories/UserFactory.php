<?php

namespace Database\Factories;

use App\Models\Group;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('ru_RU'); // Установка локали для русского языка

        $groupIds = Group::pluck('id')->all();
        $randomGroupId = array_rand($groupIds);

        $socialLinks = [
            'facebook' => $faker->url,
            'twitter' => $faker->url,
            'instagram' => $faker->url,
        ];

        return [
            'group_id' => $groupIds[$randomGroupId],
            'login' => fake()->unique()->userName,
            'password' => Hash::make('111'),
            'name_first' => $faker->firstName,
            'name_last' => $faker->lastName,
            'name_middle' => $faker->middleName(),
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'social' => json_encode($socialLinks),
            'entered_at' => fake()->date(),
            'birthdate' => fake()->dateTimeThisCentury(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

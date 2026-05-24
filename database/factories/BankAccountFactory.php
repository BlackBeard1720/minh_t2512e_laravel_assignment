<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('vi_VN');

        $createdAt = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'account_number' => $faker->unique()->numerify('##########'),
            'full_name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->phoneNumber(),
            'balance' => $faker->numberBetween(10000, 500000000),
            'status' => $faker->randomElement(['active', 'inactive', 'banned']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}

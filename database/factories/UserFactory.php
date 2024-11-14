<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'country' => 'USA',
            'state' => 'Florida',
            'post_code' => '12345',
            'address' => '123 Sample Street',
            'logo' => 'sample_logo.png',
            'org_website' => 'https://sampleclub.com',
            'color' => '#000000',
            'org_email' => 'info@sampleclub.com',
            'org_phone' => '123-456-7890',
            'incorporate_number' => 'INC123456',
            'business_number' => 'BUS123456',
            'description' => 'A sample club for seeding purposes.'
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

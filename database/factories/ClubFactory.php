<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Team;
use App\Models\User;
use App\Models\Contact;
use App\Models\ClubAdmin;
use App\Models\FixtureSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Club>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'type' => $this->faker->randomElement(['club', 'league']),
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (Club $club) {
            // ...
        })->afterCreating(function (Club $club) {
            $user = User::factory()->create([
                'userable_uuid' => $club->uuid,
                'userable_type' => Club::class
            ]);
            Contact::factory()->count(5)->create([
                'user_uuid' => $user->uuid
            ]);
            Team::factory()->count(5)->create([
                'club_uuid' => $club->uuid
            ]);
            ClubAdmin::factory()->create([
                'club_uuid' => $club->uuid
            ]);
            $user->assignRole('club');

            FixtureSession::factory()->create([
                'club_uuid' => $club->uuid
            ]);
        });
    }
}

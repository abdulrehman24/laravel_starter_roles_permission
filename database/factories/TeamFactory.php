<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use App\Models\TeamAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
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
            'sport_type' => 'football',
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (Team $team) {
            // ...
        })->afterCreating(function (Team $team) {
            $user = User::factory()->create([
                'userable_uuid' => $team->uuid,
                'userable_type' => Player::class
            ]);
            TeamAdmin::factory()->create([
                'team_uuid' => $team->uuid
            ]);
            $user->assignRole('team');
            Player::factory()->count(6)->create([
                'team_uuid' => $team->uuid
            ]);
        });
    }
}

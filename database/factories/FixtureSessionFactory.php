<?php

namespace Database\Factories;

use App\Models\FixtureEvent;
use App\Models\FixtureSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FixtureSession>
 */
class FixtureSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word() . '-' . date('Y'),
            'status' => 1,
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (FixtureSession $fixtureSession) {
            // ...
        })->afterCreating(function (FixtureSession $fixtureSession) {
            $club = $fixtureSession->club;
            $teams = $club->teams;
            foreach ($teams as $key => $team) {
                $remainder = $key % 2;
                if ($remainder == 1) {
                     FixtureEvent::factory()->create([
                        'fixture_session_uuid' => $fixtureSession->uuid,
                        'team_1_uuid' => $team->uuid,
                        'team_2_uuid' => $teams[$key - 1]->uuid,

                    ]);
                }

            }
        });
    }
}

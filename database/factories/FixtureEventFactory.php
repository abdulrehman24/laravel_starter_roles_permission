<?php

namespace Database\Factories;

use App\Models\FixtureEvent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FixtureEvent>
 */
class FixtureEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => fake()->city(),
            'scheduled_time' => Carbon::now()->addDays(rand(1, 7))->format('Y-m-d H:i:s'),
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (FixtureEvent $fixtureEvent) {
            // ...
        })->afterCreating(function (FixtureEvent $fixtureEvent) {
            $team1 = $fixtureEvent->team1;

            $team2 = $fixtureEvent->team2;

            $fixtureEvent->statistics()->create([
                'player_uuid' => $team1->players()->inRandomOrder()->first()->uuid,
                'performance_data' => json_encode(['goals' => 1, 'assists' => 1]),

            ]);
            $fixtureEvent->statistics()->create([
                'player_uuid' => $team2->players()->inRandomOrder()->first()->uuid,
                'performance_data' => json_encode(['goals' => 1, 'assists' => 1]),

            ]);
        });
    }
}

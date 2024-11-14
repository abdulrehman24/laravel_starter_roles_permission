<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'position' => fake()->randomElement(['Goalkeeper', 'Defender', 'Midfielder', 'Forward']),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Player $player) {
            // ...
        })->afterCreating(function (Player $player) {
            $user = User::factory()->create([
                'userable_uuid' => $player->uuid,
                'userable_type' => Player::class
            ]);
            
            $user->assignRole('player');
        });
    }
}

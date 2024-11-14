<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TeamAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamAdmin>
 */
class TeamAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (TeamAdmin $teamAdmin) {
            // ...
        })->afterCreating(function (TeamAdmin $teamAdmin) {
            $user = User::factory()->create([
                'userable_uuid' => $teamAdmin->uuid,
                'userable_type' => TeamAdmin::class
            ]);
            $user->assignRole('team admin');
        });
    }
}

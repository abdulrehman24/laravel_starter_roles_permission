<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ClubAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClubAdmin>
 */
class ClubAdminFactory extends Factory
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
        return $this->afterMaking(function (ClubAdmin $clubAdmin) {
            // ...
        })->afterCreating(function (ClubAdmin $clubAdmin) {
            $user = User::factory()->create([
                'userable_uuid' => $clubAdmin->uuid,
                'userable_type' => ClubAdmin::class
            ]);
            $user->assignRole('club admin');
        });
    }
}

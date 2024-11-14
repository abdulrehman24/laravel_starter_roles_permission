<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FixtureEvent;
use App\Models\Player;
use App\Models\Statistic;

class StatisticsSeeder extends Seeder
{
    public function run()
    {
        $fixture = FixtureEvent::first();
        $player = Player::first();
        $team1 = $fixture->team_1_uuid;
        $team2 = $fixture->team_2_uuid;

        // Create statistics entry
        Statistic::create([
            'fixture_event_uuid' => $fixture->uuid,
            'player_uuid' => $player->uuid,
            'team_1_uuid' => $team1,
            'team_2_uuid' => $team2,
            'performance_data' => json_encode(['goals' => 1, 'assists' => 1]),
        ]);
    }
}

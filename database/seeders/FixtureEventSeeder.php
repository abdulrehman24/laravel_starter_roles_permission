<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\FixtureSession;
use App\Models\FixtureEvent;

class FixtureEventSeeder extends Seeder
{
    public function run()
    {
        $session = FixtureSession::first();
        $team1 = Team::first();
        $team2 = Team::skip(1)->first(); 

        FixtureEvent::create([
            'fixture_session_uuid' => $session->uuid,
            'team_1_uuid' => $team1->uuid,
            'team_2_uuid' => $team2->uuid,
            'location' => 'Stadium A',
            'scheduled_time' => now()->addDays(7),
        ]);
    }
}

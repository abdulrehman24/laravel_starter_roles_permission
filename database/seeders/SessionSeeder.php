<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\FixtureSession;

class SessionSeeder extends Seeder
{
    public function run()
    {
        $club = Club::first();

        // Create a session for the club
        FixtureSession::create([
            'name' => 'Winter Session',
            'club_uuid' => $club->uuid,
            'status' => true,
        ]);
    }
}

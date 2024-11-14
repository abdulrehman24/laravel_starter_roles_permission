<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    const ROUTES = [
        'announcements.add',
        'announcements.edit',
        'announcements.view',
        'announcements.delete',

        'clubs.add',
        'clubs.edit',
        'clubs.view',
        'clubs.delete',

        'club_admins.add',
        'club_admins.edit',
        'club_admins.view',
        'club_admins.delete',

        'contacts.add',
        'contacts.edit',
        'contacts.view',
        'contacts.delete',

        'fixture_events.add',
        'fixture_events.edit',
        'fixture_events.view',
        'fixture_events.delete',

        'fixture_sessions.add',
        'fixture_sessions.edit',
        'fixture_sessions.view',
        'fixture_sessions.delete',

        'players.add',
        'players.edit',
        'players.view',
        'players.delete',

        'statistics.add',
        'statistics.edit',
        'statistics.view',
        'statistics.delete',

        'teams.add',
        'teams.edit',
        'teams.view',
        'teams.delete',

        'roles.add',
        'roles.edit',
        'roles.view',
        'roles.delete',

    ];

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        foreach (self::ROUTES as $value) {
                Permission::create([
                    'name' => $value,
                    'guard_name' => 'web',
                ]);
        }
    }
}

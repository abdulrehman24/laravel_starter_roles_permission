<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ClubSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SessionSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\StatisticsSeeder;
use Database\Seeders\SuperAdminTableSeeder;
use Database\Seeders\FixtureEventSeeder;
use Database\Seeders\RoleHasPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionsSeeder::class,
            SuperAdminTableSeeder::class,
            ClubSeeder::class,
            // SessionSeeder::class,
            // FixtureEventSeeder::class,
            // StatisticsSeeder::class,
            // Add other seeders if you have any
        ]);
    }
}

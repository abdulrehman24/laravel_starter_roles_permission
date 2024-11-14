<?php

namespace Database\Seeders;

use App\Models\Club;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\ClubAdmin;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Permission;
use Database\Factories\UserFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define permissions and create them if they don't exist
        $permissions = ['edit articles', 'delete articles', 'publish articles', 'unpublish articles'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $clubRole = Role::firstOrCreate(['name' => 'club']);
        $clubRole->givePermissionTo(Permission::all());

        $teamOwnerRole = Role::firstOrCreate(['name' => 'teamowner']);
        $teamOwnerRole->givePermissionTo(Permission::all());

        $playerRole = Role::firstOrCreate(['name' => 'player']);
        $playerRole->givePermissionTo(Permission::all());

        // Create sample users with roles
        // $user1 = User::firstOrCreate(
        //     ['email' => 'admin@gmail.com'],
        //     [
        //         'name' => 'Admin',
        //         'password' => Hash::make('admin123')
        //     ]
        // );
        // $user1->assignRole('admin');
        // Create the Club model instance linked to the user
        $club = Club::firstOrCreate([
            'name' => 'Sample Club',
            'type' => 'Professional',
            'created_at' => now(),
        ]);
        // Create a club user with additional fields
        $user2 = User::factory()->create(
            [
                'userable_uuid' => $club->uuid,
                'userable_type' => ClubAdmin::class,
            ]
        );
        $user2->assignRole('club admin');
        $clubAdmin = ClubAdmin::create([
            'club_uuid' => $club->uuid,
        ]);

        // Create a club user with additional fields
        $user2 = User::firstOrCreate(
            ['email' => fake()->unique()->safeEmail()],
            [
                'name' => 'Club',
                'userable_uuid' => $clubAdmin->uuid,
                'userable_type' => ClubAdmin::class,
                'password' => Hash::make('12345678'),
                'country' => 'Sample Country',
                'state' => 'Sample State',
                'post_code' => '12345',
                'address' => '123 Sample Street',
                'logo' => 'sample_logo.png',
                'org_website' => 'https://sampleclub.com',
                'color' => '#000000',
                'org_email' => 'info@sampleclub.com',
                'org_phone' => '123-456-7890',
                'incorporate_number' => 'INC123456',
                'business_number' => 'BUS123456',
                'description' => 'A sample club for seeding purposes.'
            ]
        );
        $user2->assignRole('club admin');



        // Create sample teams for the club
        $teams = [
            ['name' => 'Team A', 'sport_type' => 'Soccer'],
            ['name' => 'Team B', 'sport_type' => 'Basketball'],
            ['name' => 'Team C', 'sport_type' => 'Hockey']
        ];

        foreach ($teams as $teamData) {
            Team::firstOrCreate([
                'club_uuid' => $club->uuid,
                'name' => $teamData['name'],
                'sport_type' => $teamData['sport_type'],
            ]);
            $clubAdmin = ClubAdmin::create([
                'club_uuid' => $club->uuid,
            ]);
        }

        // Create a sample player user
        $user3 = User::firstOrCreate(
            ['email' => fake()->unique()->safeEmail()],
            [
                'name' => 'Player',
                'password' => Hash::make('12345678')
            ]
        );
    }
}

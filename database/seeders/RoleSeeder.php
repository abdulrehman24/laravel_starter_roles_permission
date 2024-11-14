<?php

namespace Database\Seeders;

use App\Models\Role;
// use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    const ROLES = [
        'super admin',
        'club',
        'club admin',
        'team',
        'team admin',
        'player',
    ];

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        foreach (self::ROLES as $value) {

            Role::create(['name' => $value]);

        }
    }
}

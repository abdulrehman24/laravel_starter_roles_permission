<?php

namespace Database\Seeders;


use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
// use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use Spatie\Permission\Models\Permission;

class RoleHasPermissionsSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $admin = Role::where('name', 'super admin')->first();
        $admin->givePermissionTo(Permission::all());

        // $user = User::where('email', 'superadmin@gmail.com')->first();
        // dd($user);
        // $user->assignRole('super admin');

    }
}

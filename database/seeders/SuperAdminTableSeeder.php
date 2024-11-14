<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminTableSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = SuperAdmin::firstOrCreate();
        $user = User::factory()->create([
            'userable_uuid' => $superAdmin->uuid,
            'email' => 'superadmin@gmail.com',
            'userable_type' => SuperAdmin::class,
        ]);
        $user->assignRole('super admin');
    }
}


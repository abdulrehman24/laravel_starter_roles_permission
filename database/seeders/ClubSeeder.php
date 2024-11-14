<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClubSeeder extends Seeder
{
    public function run()
    {
         Club::factory()->count(5)->create();
    
    }
}

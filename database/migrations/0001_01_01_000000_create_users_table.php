<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->char('userable_uuid', 36);//1,2
            $table->string('userable_type');//superadmin,club
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('post_code')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('org_website')->nullable();
            $table->string('color')->nullable();
            $table->string('org_email')->nullable();
            $table->string('org_phone')->nullable();
            $table->string('incorporate_number')->nullable();
            $table->string('business_number')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }
    //super admin, club,club admin,teamowner,team admin,player

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

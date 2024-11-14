<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fixture_events', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('fixture_session_uuid')->references('uuid')->on('fixture_sessions');
            $table->foreignUuid('team_1_uuid')->references('uuid')->on('teams');
            $table->foreignUuid('team_2_uuid')->references('uuid')->on('teams');
            $table->string('location');
            $table->dateTime('scheduled_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture_events');
    }
};

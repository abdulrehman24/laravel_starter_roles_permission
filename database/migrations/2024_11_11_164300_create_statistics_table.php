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
        Schema::create('statistics', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('fixture_event_uuid')->references('uuid')->on('fixture_events');
            $table->foreignUuid('player_uuid')->references('uuid')->on('players');
            $table->string('performance_data');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};

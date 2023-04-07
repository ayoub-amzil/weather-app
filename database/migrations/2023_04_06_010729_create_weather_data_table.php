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
        Schema::create('weather_data', function (Blueprint $table) {
            $table->increments('weather_data_id');
            $table->float('latitude', 10, 5);
            $table->float('longitude', 10, 5);
            $table->decimal('generationtime_ms', 18, 17);
            $table->integer('utc_offset_seconds');
            $table->string('timezone', 255);
            $table->string('timezone_abbreviation', 255);
            $table->integer('elevation');
            $table->string('hourly_units_time', 255);
            $table->string('hourly_units_temperature', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};

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
        Schema::create('weather_hourly_data', function (Blueprint $table) {
            $table->increments('weather_hourly_id');
            $table->dateTime('hourly_data_time');
            $table->float('hourly_data_temperature', 10, 5);
            $table->integer('weather_data_id')->unsigned()->nullable();
            $table->foreign('weather_data_id')->references('weather_data_id')->on('weather_data')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_hourly_data');
    }
};

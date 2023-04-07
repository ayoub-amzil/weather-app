<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = 'weather_data';
    protected $primaryKey = 'weather_data_id';
    protected $fillable = [
        'latitude',
        'longitude',
        'generationtime_ms',
        'utc_offset_seconds',
        'timezone',
        'timezone_abbreviation',
        'elevation',
        'hourly_units_time',
        'hourly_units_temperature',
    ];

    public function hourlyData()
    {
        return $this->hasMany(WeatherHourly::class, 'weather_data_id');
    }
}


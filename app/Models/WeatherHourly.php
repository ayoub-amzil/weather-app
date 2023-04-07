<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherHourly extends Model
{
    use HasFactory;
    protected $table = 'weather_hourly_data';
    protected $primaryKey = 'weather_hourly_id';
    protected $fillable = [
        'hourly_data_time',
        'hourly_data_temperature',
    ];

    public function weatherData()
    {
        return $this->belongsTo(Weather::class, 'weather_data_id');
    }
}

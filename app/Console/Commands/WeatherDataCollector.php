<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WeatherController; // DRY concept. I re-use the getData() method from weatherController


class WeatherDataCollector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect weather data from API every 15 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Instantiate the WeatherController 
        $weatherController = new WeatherController();
        // Call the getData() method
        $weatherController->gWeatherData();
        // Output success message
        $this->info('Weather data collected successfully!');
    }
}

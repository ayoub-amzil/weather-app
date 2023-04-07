<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('weather:collect')->everyFifteenMinutes();

/*
$schedule->command('weather:collect')->everyMinute(); // Uncomment this for testing
php artisan schedule:work // And execut this 
---
You would not add a scheduler cron entry to your local development machine...
source : https://laravel.com/docs/10.x/scheduling#running-the-scheduler-locally
*/


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
    }
}

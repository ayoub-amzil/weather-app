<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessWeatherData;


class RunWeatherDataJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run gWeatherData() method using Laravel queue system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new ProcessWeatherData());
        $this->info('Weather data processing job has been queued successfully!');
    }
}

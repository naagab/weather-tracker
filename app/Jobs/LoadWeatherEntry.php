<?php

namespace App\Jobs;

use App\Models\WeatherEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class LoadWeatherEntry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $weatherEntry;

    public $tries = 2;
    /**
     * Create a new job instance.
     *
     * @param WeatherEntry $entry
     * @return void
     */
    public function __construct($entry)
    {
        $this->weatherEntry = $entry;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->weatherEntry->request();
        $this->weatherEntry->save();
    }

    /**
     * Logging failed job
     *
     * @param null $exception
     */
    public function fail($exception = null)
    {
        Log::error('OpenWeatherMap Job Failed');
    }
}

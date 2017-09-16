<?php

namespace App\Console\Commands;

use App\Jobs\LoadWeatherEntry;
use App\Models\WeatherEntry;
use App\Models\Zipcode;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class TrackWeather extends Command
{
    protected $signature = 'weatherdata';
    //protected $entryWaitInMin = 1;



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zips = ZipCode::allZips();
        $zips = $this->getZips();
        foreach ($zips as $zipCode=>$waitMins) {
            if ($this->checkEntryRequired($zipCode, $waitMins)) {
                $this->queueEntry($zipCode);
            }
        }
        return true;
    }


    /**
     * return the content(zips) in the data config file
     *
     * @return mixed
     */
    protected function getZips(){
        return config('data.zip_codes');
    }

    /**
     * check if new row needs to be added to the weatherentries table
     *
     * @param $zipCode
     * @param $frequency
     * @return bool
     */
    protected function checkEntryRequired($zipCode, $frequency) {
        $weatherEntry = WeatherEntry::FindLastEntry($zipCode)->first(['created_at']);
        if (!$weatherEntry) {
            return true;
        }
        $LastEntryTime = Carbon::now()->diffInMinutes($weatherEntry->created_at);
        return $LastEntryTime >= $frequency;
    }

    /**
     * @param $zipCode
     */
    protected function queueEntry($zipCode) {
        $entry = new WeatherEntry(['zip_code' => $zipCode]);
        $entry->save();
        dispatch(new LoadWeatherEntry($entry));
    }
}
<?php

namespace app;

use Log;
class WeatherApi
{

    protected $zip;
    protected $apiurl = 'http://api.openweathermap.org/data/2.5/';
    protected $country_code = 'US';

    public function __construct($zipCode){
        $this->zip = $zipCode;
    }

    /**
     * Call Weather API
     *
     * @return string
     */
    public function loadApi() {
        $guzzcl = new \GuzzleHttp\Client(['base_uri' => $this->apiurl]);
        $result = $guzzcl->get('weather', ['query' => $this->getParameters()]);
        if (!$this->validateResponse($result)) {
            throw new Exception('Invalid WeatherMap response');
        }
        //Log::error($result->getBody()->getContents());
        return $result->getBody()->getContents();
    }

    /**
     *  set and retrieve parameters for API Call
     * @return array
     */
    protected function getParameters() {
        return [
            'units' => 'imperial',
            'zip' => $this->zip . ',' . $this->country_code,
            'appid' => config('services.openweathermap.key')
        ];
    }

    /**
     * return success or failure of API call
     *
     * @param $result
     * @return bool
     */
    protected function validateResponse($result) {
        return $result->getStatusCode() == 200;
    }

}
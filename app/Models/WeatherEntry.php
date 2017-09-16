<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherEntry extends Model
{

    protected $fillable = ['zip_code'];

    public function request() {
        $weatherService = new \App\WeatherApi($this->zip_code);
        $this->response = $weatherService->loadApi();
        $this->setData();
    }

    protected function setData() {
        $response = json_decode($this->response);
        $this->location = $response->name;
        $this->conditions = $response->weather[0]->main;
        $this->temperature = $response->main->temp;
        $this->pressure = $response->main->pressure;
        $this->humidity = $response->main->humidity;
        $this->wind_speed = $response->wind->speed;
        $this->wind_direction = $response->wind->deg;
        $this->country_code = $response->sys->country;
    }

    public function scopeFindLastEntry($query, $zip) {
        return $query->where('zip_code', $zip)->orderByDesc('created_at');
    }
}

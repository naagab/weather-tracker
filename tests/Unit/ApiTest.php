<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\WeatherApi;

class ApiTest extends TestCase
{
    /** @test */

    function load_Api(){
       $api = new WeatherApi('37214');
       $this->assertNotEmpty($api->loadApi());
       $this->assertObjectHasAttribute('name', json_decode($api->loadApi()));
       $this->assertObjectHasAttribute('weather', json_decode($api->loadApi()));
       $this->assertObjectHasAttribute('main', json_decode($api->loadApi()));
       $this->assertObjectHasAttribute('wind', json_decode($api->loadApi()));
       $this->assertObjectHasAttribute('sys', json_decode($api->loadApi()));
    }

}

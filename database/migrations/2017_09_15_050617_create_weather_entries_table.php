<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_code', 2)->nullable();
            $table->string('zip_code', 10);
            $table->string('location')->nullable();
            $table->string('conditions')->nullable();
            $table->float('temperature')->nullable();
            $table->float('pressure')->nullable();
            $table->float('humidity')->nullable();
            $table->float('wind_speed')->nullable();
            $table->float('wind_direction')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_entries');
    }
}

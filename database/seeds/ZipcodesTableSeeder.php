<?php

use Illuminate\Database\Seeder;

class ZipcodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zips = [['id' => 1, 'zip'=>'37214'],['id' => 2, 'zip'=>'10001'],['id' => 3, 'zip'=>'30301']];
        DB::table('zipcodes')->insert($zips);
    }
}

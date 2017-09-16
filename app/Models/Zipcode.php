<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    public static function allZips(){
        return static::all(['zip'])->pluck('zip')->toArray();
    }
}

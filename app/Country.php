<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;

    public function scopegetCountry()
    {
        $countries = Country::get(['id', 'nicename']);
        $arr[0] = "Country";
        foreach ($countries as $country) {
            $arr[$country->id] = $country->nicename;
        }
        return $arr;
    }
}

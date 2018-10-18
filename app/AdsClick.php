<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsClick extends Model
{
    protected $table = 'ads_clicked';
    public $timestamps = false;

    public function scopeGetAds($query)
    {
        return $query->get();
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel', 'user_id');
    }

    public function ads()
    {
        return $this->belongsTo('App\Ads', 'ad_id');
    }

}

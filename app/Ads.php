<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    public $timestamps = false;

    public function scopeGetActiveAds($query)
    {
        return $query->where(['is_active' => 1, 'is_approved' => 1])->get();
    }

    public function scopeGetPendingAds($query)
    {
        return $query->where(['is_active' => 1, 'is_approved' => 0])->limit(5)->get();
    }

    public function scopeGetActiveAdsAdmin($query)
    {
        return $query->where(['is_active' => 1])->get();
    }

    public function ad_cat()
    {
        return $this->belongsTo('App\AdCategory', 'ad_category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel', 'user_id');
    }

    public static function getAds($id)
    {
        $results = array();
        $ads_img = array();
        $ads = Ads::where(['user_id' => request('user_id'), 'is_active' => 1])->get();
        foreach ($ads as $ad)
            $ads_img = AdsImages::where(['ad_id' => $ad->id])->get();

        foreach ($ads as $item) {
            $results[] = ['id' => $item->id, 'ad_title' => $item->ad_title, 'ad_description' => $item->ad_description, 'ad_category_id' => $item->ad_category_id, 'other_cat' => $item->other_cat, 'user_id' => $item->user_id, 'city' => $item->city, 'status' => $item->status, 'is_approved' => $item->is_approved, 'is_active' => $item->is_active, 'created_time' => $item->created_time, 'ad_img' => $ads_img];
        }
        return $results;
    }
}

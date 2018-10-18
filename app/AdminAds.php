<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminAds extends Model
{
    protected $table = 'admin_ads';
    public $timestamps = false;

    public function scopeGetAdminAds($query)
    {
        return $query->where(['is_active' => 1])->get();
    }

    public function scopeGetPopAds($query)
    {
        return $query->where(['is_active' => 1, 'is_slider' => 0])->get();
    }
}

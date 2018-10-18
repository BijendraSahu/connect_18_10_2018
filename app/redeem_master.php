<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class redeem_master extends Model
{
    protected $table = 'redeem_masters';
    public $timestamps = false;

    public function scopeGetPendingRedeem($query)
    {
        return $query->where(['is_active' => 1, 'is_approved' => 0])->get();
    }

    public function scopeGetAllRedeem($query)
    {
        return $query->where(['is_active' => 1])->get();
    }
}

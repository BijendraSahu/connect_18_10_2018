<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    public $timestamps = false;

    public function scopeGetRegs($query)
    {
        return $query->get();
    }

    public function scopeGetfreeRegs($query)
    {
        return $query->where(['active' => 1, 'member_type' => 'free'])->get();
    }

    public function scopeGetpaidRegs($query)
    {
        return $query->where(['active' => 1, 'member_type' => 'paid'])->get();
    }

    public function timeline()
    {
        return $this->belongsTo('App\Timeline', 'timeline_id');
    }

    public static function checkrc($rc)
    {
        $user = UserModel::where(['rc' => $rc])->first();
        if (is_null($user)) return true;
        else return false;
    }

    public static function checkcontact($c)
    {
        $user = UserModel::where(['contact' => $c])->first();
        if (is_null($user)) return true;
        else return false;
    }

    public static function checkemail($c)
    {
        $user = UserModel::where(['email' => $c])->first();
        return (is_null($user)) ? true : false;
    }
}

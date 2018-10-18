<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\UserModel', 'user_id');
    }
}

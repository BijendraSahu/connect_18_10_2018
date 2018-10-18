<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\UserModel', 'user_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    public $timestamps = false;

    public function timeline()
    {
        return $this->belongsTo('App\Timeline', 'timeline_id');
    }

    public function user()
    {
        return $this->belongsTo('App\UserModel', 'user_id');
    }

}

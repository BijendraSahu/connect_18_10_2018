<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    public $timestamps = false;

    public function scopeGetNotification($query)
    {
        return $query->get();
    }

    public function admin()
    {
        return $this->belongsTo('App\AdminModel', 'created_by');
    }
}

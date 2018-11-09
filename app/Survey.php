<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'survey';
    public $timestamps = false;

    public function scopeGetSurveys($query)
    {
        return $query->where(['is_active' => 1])->get();
    }
}

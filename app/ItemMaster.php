<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemMaster extends Model
{
    protected $table = 'item_master';
    public $timestamps = false;
}

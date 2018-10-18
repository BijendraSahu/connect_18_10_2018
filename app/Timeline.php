<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timeline extends Model
{
    protected $table = 'timelines';
    public $timestamps = false;

    public static function getUser($key_term, $id)
    {
        $results = array();
//        $items = DB::select("SELECT tline.ItemName, tline.ItemID  FROM item_master item WHERE tline.ItemName LIKE '" . $key_term . "%' ORDER BY tline.ItemName ASC");
        $items = DB::select("SELECT tline.name, u.id  FROM timelines tline, users u WHERE tline.name LIKE '" . $key_term . "%' and tline.id = u.timeline_id ORDER BY tline.name ASC");
        foreach ($items as $item)
            $results[] = ['label' => $item->name, 'uid' => $item->id, 'uname' => $item->name];
        return $results;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    protected $table = 'ad_category';
    public $timestamps = false;

    public function scopeGetCategoryDropdown()
    {
        $cats = AdCategory::where('is_active', '1')->get(['id', 'category']);
        $arr[0] = 'Select';
        foreach ($cats as $cat) {
            $arr[$cat->id] = $cat->category;
        }
        return $arr;
    }
}

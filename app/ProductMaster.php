<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductMaster extends Model
{
    public $table = 'item_master';
    public $timestamps = false;


    public static function getname($key_term)
    {
        $results = array();
//        $items = DB::table('products')->where('name', 'like', '%' . $key_term . '%')->distinct('name')->take(8)->get();
        $sql = "SELECT * FROM products WHERE name LIKE ' % " . $key_term . " % ' ORDER BY name ASC";
        $items = DB::select($sql);;
        foreach ($items as $item)
            $results[] = ['label' => $item->name, 'id' => $item->id, 'name' => $item->name];
        return $results;
//        if (count($results))
//            return $results;
//        else
//            return ['value' => 'No Result Found', 'id' => ''];
    }

    public static function getProducts($id)
    {
        $results = array();
//        $product_prices = array();
        $products = ProductMaster::where(['status' => 1, 'id' => request('product_id')])->get();
        $product_prices = ItemPrice::where(['is_active' => 1, 'item_master_id' => request('product_id')])->get();
        $product_category = ItemCategory::where(['is_active' => 1, 'item_master_id' => request('product_id')])->get();
        $product_images = ItemImages::where(['product_id' => request('product_id')])->get();

        foreach ($products as $item) {
            $results[] = ['id' => $item->id, 'name' => $item->name, 'shipping_rate' => $item->shipping_rate, 'status' => $item->status, 'description' => $item->description, $product_images, $product_prices, $product_category];
        }
        return $results;
    }

    public function scopegetProduct()
    {
        $products = ProductMaster::where('status', '1')->get();
        $arr[0] = "SELECT";
        foreach ($products as $product) {
            $arr[$product->id] = $product->name;
        }
        return $arr;
    }
}

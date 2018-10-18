<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\ItemMaster;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

session_start();

class ProductController extends BaseController
{

    public function create()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = UserModel::find($user_ses->id);
        return view('ecommerse.create_product_new', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('products')
                ->withErrors($validator)
                ->withInput();
        }

        $products = new ItemMaster();
        $products->name = Input::get('name');
        $products->price = request('price');
        $products->description = request('description');
//        $file = $request->file('image');
//        $destinationPath = 'images';
//        if (request('image') != null) {
//            $temp = uniqid() . '_img.' . $file->getClientOriginalName();
//            $file->move($destinationPath, $temp);
//            $filename = 'images/' . $temp;
//            $products->image = $filename;
//        }

        $file = $request->file('image');
        if (request('image') != null) {
            $destination_path = 'images/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $products->image = $destination_path . $filename;
        }
        $products->save();
        return redirect('products')->with('message', 'Product has been added');

    }

    public function show()
    {
        $products = DB::table('item_master')->where('is_active', '1')->get();
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('ecommerse.products', ['products' => $products, 'user' => $user]);
    }

    public function edit($id)
    {
        $product = DB::selectOne("select * from item_master where id = $id");
        $user_ses = $_SESSION['admin_master'];
        $user = UserModel::find($user_ses->id);
        return view('ecommerse.edit_product_new', ['product' => $product, 'user' => $user]);
    }

    public function update($id, Request $request)
    {
        echo request('image');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('products')
                ->withErrors($validator)
                ->withInput();
        }
        $products = ItemMaster::find($id);
        $products->name = Input::get('name');
        $products->price = request('price');
        $products->description = request('description') != null ? request('description') : '';
//        $destinationPath = 'images';
//        if (request('image') != null) {
//            $temp = uniqid() . '_img.' . $file->getClientOriginalName();
//            $file->move($destinationPath, $temp);
//            $filename = 'images/' . $temp;
//            $products->image = $filename;
//        }

        $file = $request->file('image');
        if (request('image') != null) {
            $destination_path = 'images/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $products->image = $destination_path . $filename;
        }

        $products->save();
        return redirect('products')->with('message', 'Product has been updated');

    }

    public function delete($id)
    {
        $products = ItemMaster::find($id);
        $products->is_active = 0;
        $products->save();
        return redirect('products')->with('message', 'Product has been deleted');
    }
}


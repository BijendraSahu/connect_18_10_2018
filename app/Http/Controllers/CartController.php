<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\Ads;
use App\ItemMaster;
use App\OrderDescription;
use App\OrderMaster;
use App\Timeline;
use App\User;
use App\UserAddress;
use App\UserModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class CartController extends Controller
{
    public function item_list()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $items = ItemMaster::where(['is_active' => 1])->get();
            $user = UserModel::find($user_ses->id);
            return view('ecommerse.item_list')->with(['user' => $user, 'timeline' => $timeline, 'items' => $items]);
        }
        return redirect('/');
    }

    public function cartload()
    {
        $cart = Cart::content();
        return view('ecommerse.cart_load')->with(['cart' => $cart]);
    }

    public function addtocart()
    {
        $item_id = request('itemid');
        $products = DB::table('item_master')->where('id', $item_id)->first();
        $quantity = request('quantity');
        $product_name = $products->name;
        $product_price = $products->price;
        if (isset($quantity) && $quantity != 0) {
            Cart::add($item_id, $product_name, $quantity, $product_price);
        } else {
            Cart::add($item_id, $product_name, 1, $product_price);
        }

        $cart = Cart::content();
        $cart_total = Cart::total();
        return view('ecommerse.cart_load')->with(['cart' => $cart]);
    }

    public function cart_update($id)
    {
        $rowId = $id;
        $quantity = request('qty');
        Cart::update($rowId, $quantity);
//        Session::flash('success - msg', 'Successfully Updated');
        return redirect()->back()->with('message', 'Cart has been updated');
    }

    public function delete($id)
    {
        $rowId = $id;
        Cart::remove($rowId);
//        \Session::flash('success-msg', 'Successfully Removed');
        return redirect()->back();
    }

    public function checkout()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $cart = Cart::content();;
            $user = UserModel::find($user_ses->id);
            $address = UserAddress::where(['user_id' => $user_ses->id])->get();
            $states = DB::select("select CID, State from cities where city is null order by State asc");
            $cities = DB::select("select * from cities where City IS NOT NULL order by City ASC");
            return view('ecommerse.checkout')->with(['user' => $user, 'timeline' => $timeline, 'cart' => $cart, 'address' => $address, 'cities' => $cities, 'states' => $states]);
        }
        return redirect('/');
    }

    public function payment(/*$amt, $cod, $addressdel, $code, */Request $request)   //////////////////Final
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $cart = Cart::content();;
            $user = UserModel::find($user_ses->id);
            if (request('existadd') == null) {
                $client_address = new UserAddress();
                $client_address->user_id = $user->id;
                $client_address->name = request('name');
                $client_address->email = request('email');
                $client_address->contact = request('contact');
                $client_address->address = request('add1');
                $client_address->zip = request('pincode');
//                $client_address->address2 = request('add2');
//                $client_address->zip = request('pin');
                $client_address->city_id = request('city');
                $client_address->state_id = request('city');
                $client_address->save();
            }

            $exist = UserAddress::find(request('existadd'));
            $addressdel1 = (request('existadd') != null) ? $exist->name . ', ' . $exist->contact . ', ' . $exist->address . ', ' . $exist->city->City . ', ' . $exist->state->State . ', ' . $exist->zip : $client_address->name . ', ' . $client_address->contact . ', ' . $client_address->address . ', ' . $client_address->city->City . ', ' . $client_address->state->State . ', ' . $client_address->zip;

            $address_id = (request('existadd') != null) ? request('existadd') : $client_address->id;
            define('SUCCESS_URL', 'https://connecting-one.com/success');  //have complete url
            define('FAIL_URL', 'https://connecting-one.com/failed');    //add complete url
            $MERCHANT_KEY = "mqqqWtY9";
            $SALT = "x2fGRxrwL7";
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            $email = (request('existadd') != null) ? $exist->email : request('email');
            $firstName = (request('existadd') != null) ? str_replace(' ', '', $exist->name) : str_replace(' ', '', request('name'));
            $amt = request('amt');
            $amt_pum = request('amt') * 3 / 100;
            $totalCost = $amt + $amt_pum;
            $mobile = (request('existadd') != null) ? $exist->contact : request('contact');
            $shipping = (request('shipping') > 0) ? request('shipping') : 0;
            $hash_string = $MERCHANT_KEY . "|" . $txnid . "|" . $totalCost . "|" . "product|" . $firstName . "|" . $email . "|1|2|3|" . $shipping . "|" . $address_id . "||||||" . $SALT;
            $hash = strtolower(hash('sha512', $hash_string));
            $_SESSION['total_amt'] = $totalCost;
            return view('ecommerse.pay_umoney_form')->with(['hash1' => $hash, 'amt' => $amt, 'amt_pum' => $amt_pum, 'txnid' => $txnid, 'totalCost' => $totalCost, 'firstName' => $firstName, 'MERCHANT_KEY' => $MERCHANT_KEY, 'SALT' => $SALT, 'addressdel1' => $addressdel1, 'email' => $email, 'mobile' => $mobile, 'address_id' => $address_id, 'hash_string' => $hash_string, 'shipping' => $shipping]);
        }
        return redirect('/');
    }


    public function payment_success()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $cart = Cart::content();;
            $user = UserModel::find($user_ses->id);
            if (count($cart) == 0) {
                return redirect('checkout')->withInput()->withErrors('Your cart is empty');
            } else {
                $order = new OrderMaster();
                $order->order_no = rand(100000, 999999);
                $order->status = 'Ordered';
                $order->user_id = $user->id;
                $order->address_id = request('udf5');
                $order->save();
                foreach ($cart as $row) {
                    $order_des = new OrderDescription();
                    $order_des->order_master_id = $order->id;
                    $order_des->item_master_id = $row->id;
                    $order_des->qty = $row->qty;
                    $order_des->unit_price = $row->price;
                    $order_des->total = $row->price * $row->qty;
                    $order_des->save();
                }
                Cart::destroy();
                return redirect('dashboard')->with('message', 'Your order has been successful...you will get confirmation mail');
            }
        }
        return redirect('/');
    }

    public function e_atom_payment()
    {
        //echo json_encode($_REQUEST);
        $status = $_REQUEST["f_code"];
        if ($status != 'F') {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $cart = Cart::content();;
            $user = UserModel::find($user_ses->id);
            if (count($cart) == 0) {
                return redirect('checkout')->withInput()->withErrors('Your cart is empty');
            } else {
                $order = new OrderMaster();
                $order->order_no = rand(100000, 999999);
                $order->status = 'Ordered';
                $order->user_id = $user->id;
                $order->address_id = request('udf4');
                $order->save();
                foreach ($cart as $row) {
                    $order_des = new OrderDescription();
                    $order_des->order_master_id = $order->id;
                    $order_des->item_master_id = $row->id;
                    $order_des->qty = $row->qty;
                    $order_des->unit_price = $row->price;
                    $order_des->total = $row->price * $row->qty;
                    $order_des->save();
                }
                Cart::destroy();
                return redirect('dashboard')->with('message', 'Your order has been successful...you will get confirmation mail');
            }
        }else{
            return redirect('dashboard')->withErrors(array('message' => 'Payment has been failed please try again...'));
        }
    }

    public function payment_failed()
    {
//        echo json_encode($_REQUEST);
//        return view('front.failed');
        return redirect('dashboard')->withErrors(array('message' => 'Payment has been failed please try again...'));
    }


}

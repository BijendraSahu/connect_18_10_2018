<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\Ads;
use App\AdsImages;
use App\Timeline;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();

class BuySellController extends Controller
{
    public function buy()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $ads = Ads::where(['is_active' => 1, 'is_approved' => 1])->orderBy('id', 'desc')->get();
            $ad_category = AdCategory::where(['is_active' => 1])->get();
            $user = UserModel::find($user_ses->id);
            return view('buy.buyandsell')->with(['user' => $user, 'timeline' => $timeline, 'ads' => $ads, 'ad_category' => $ad_category]);
        }
        return redirect('/');
    }

    public function create()
    {
        $cats = AdCategory::GetCategoryDropdown();
        return view('buy.create_add')->with(['cats' => $cats]);
    }

    public function myads()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $ads = Ads::where(['user_id' => $user_ses->id, 'is_active' => 1])->get();
            $ad_category = AdCategory::where(['is_active' => 1])->get();
            $user = UserModel::find($user_ses->id);
            return view('ads.my_ads')->with(['user' => $user, 'timeline' => $timeline, 'ads' => $ads, 'ad_category' => $ad_category]);
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        if ($request->file('ad_img') == '') {
            return redirect('myads')->withInput()->withErrors('Please select ad image');
        } else {
            $ads = new Ads();
            $ads->ad_title = request('title');
            $ads->ad_category_id = request('ddcategory') > 0 ? request('ddcategory') : null;
            $ads->other_cat = request('other');
            $ads->ad_description = request('add_details');
            $ads->user_id = $_SESSION['user_master']->id;
            $ads->city = request('city');
            $ads->save();
            $file = $request->file('ad_img');
            if (request('ad_img') != null) {
                $adimg = new AdsImages();
                $destination_path = 'buysell/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $file->move($destination_path, $filename);
                $adimg->image_url = $destination_path . $filename;
                $adimg->ad_id = $ads->id;
                $adimg->save();
            }
            return redirect('myads')->with('message', 'Your ad has been submitted...after approval it will be shown');
        }

    }


    public function buysellbycategory($eid)
    {
        $adid = decrypt($eid);
        $user_ses = $_SESSION['user_master'];
        $ads = Ads::where(['ad_category_id' => $adid, 'is_active' => 1, 'is_approved' => 1])->get();
        $timeline = Timeline::find($user_ses->timeline_id);
        $user = UserModel::find($user_ses->id);
        $selected_category = AdCategory::find($adid);
        if (isset($ads)) {
            $ad_category = AdCategory::where(['is_active' => 1])->get();
            return view('buy.buyandsellcategory')->with(['user' => $user, 'timeline' => $timeline, 'ads' => $ads, 'ad_category' => $ad_category, 'selected_category' => $selected_category]);
        }
        return redirect('dashboard');
    }

    public function delete($id)
    {
        $Cate = Ads::find($id);
        $Cate->is_active = 0;
        $Cate->save();
        return redirect('myads')->with('message', 'Ad has been deleted...!');
    }
}

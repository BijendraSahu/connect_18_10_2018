<?php

namespace App\Http\Controllers;

use App\AdminAds;
use App\AdminModel;
use App\AdsClick;
use App\NotificationClicked;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminAdsController extends Controller
{
    public function index()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.advertisement.advertise_list')->with(['adminads' => AdminAds::GetAdminAds(), 'user' => $user]);
    }

    public function create()
    {
        return view('admin.advertisement.create_advertise');
    }

    public function store(Request $request)
    {
        if ($request->file('add_img') == null) {
            return Redirect::back()->withInput()->withErrors('Please select any image');
        }
        $ads = new AdminAds();
        $ads->ad_title = request('title');
        $ads->ad_description = request('add_details');
        $ads->is_slider = request('is_slider');
        $file = $request->file('add_img');
        $destination_path = 'buysell/';
        $filename = str_random(6) . '_' . $file->getClientOriginalName();
        $file->move($destination_path, $filename);
        $ads->ad_img = $destination_path . $filename;
        $ads->save();
        return redirect('advertisement')->with('message', 'Advertisement has been added...!');
    }


    public function edit($id)
    {
        $ad = AdminAds::find($id);
//        echo json_encode($ad);
        return view('admin.advertisement.edit_advertise')->with(['ad' => $ad]);
    }

    public function update($id, Request $request)
    {
//        if ($request->file('add_img') == null) {
//            return Redirect::back()->withInput()->withErrors('Please select any image');
//        }
        $ads = AdminAds::find($id);
        $ads->ad_title = request('title');
        $ads->ad_description = request('add_details');
        $ads->is_slider = request('is_slider');
        $file = $request->file('add_img');
        if ($request->file('add_img') != null) {
            $destination_path = 'buysell/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $ads->ad_img = $destination_path . $filename;
        }
        $ads->save();
        return redirect('advertisement')->with('message', 'Advertisement has been updated...!');
    }

    public
    function destroy($id)
    {
        $Units = AdminAds::find($id);
        $Units->is_active = 0;
        $Units->save();
        return redirect('advertisement')->with('message', 'Advertisement has been deleted...!');
    }

    public
    function postadsclick()
    {
        $user = $_SESSION['user_master'];
        $tids = explode(",", request('adids'));
        foreach ($tids as $adsid) {
            $adclicks = AdsClick::where(['user_id' => $user->id, 'ad_id' => $adsid])->get();
            if (count($adclicks) > 0) {
                foreach ($adclicks as $adclick) {
                    $adclick->click_count += 1;
                    $adclick->clicked_date = Carbon::parse(Carbon::now())->format('Y-m-d');
                    $adclick->save();
                }
            } else {
                $ads_click = new AdsClick();
                $ads_click->user_id = $user->id;
                $ads_click->ad_id = $adsid;
                $ads_click->click_count = 1;
                $ads_click->clicked_date = Carbon::parse(Carbon::now())->format('Y-m-d');
                $ads_click->save();
            }
        }
    }

    public
    function notification_click()
    {
        $user = $_SESSION['user_master'];
        $adclicks = NotificationClicked::where(['user_id' => $user->id])->first();
        if (isset($adclicks)) {
            $adclicks->click_count += 1;
            $adclicks->clicked_date = Carbon::parse(Carbon::now())->format('Y-m-d');
            $adclicks->save();
        } else {
            $ads_click = new NotificationClicked();
            $ads_click->user_id = $user->id;
            $ads_click->click_count = 1;
            $ads_click->clicked_date = Carbon::parse(Carbon::now())->format('Y-m-d');
            $ads_click->save();
        }
    }
}

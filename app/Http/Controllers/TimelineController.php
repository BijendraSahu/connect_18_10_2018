<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\AdminAds;
use App\com;
use App\Country;
use App\Friend;
use App\Notification;
use App\Timeline;
use App\User;
use App\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class TimelineController extends Controller
{

    public function profile()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $country = Country::getCountry();
            $timeline = Timeline::find($user_ses->timeline_id);
            $_SESSION['user_timeline'] = $timeline;
            $user = UserModel::find($user_ses->id);
            return view('profile.profile_update')->with(['user' => $user, 'timeline' => $timeline, 'country' => $country]);
        } else {
            return redirect('/')->withInput()->withErrors(array('message' => 'Session Invalid'));
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
//            $tbls = Tbl_Table::where(['Isdeleted' => 0])->get();
//            $menucat = MenuCategory::where(['Isdeleted' => 0])->get();
//            $menusub = MenuSubCategory::where(['Isdeleted' => 0])->get();
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
            // Top 10 Earners
            $com = new com();
            $cm_id = $com::select('ParentID as UserID', DB::raw("SUM(Com) as Commission"))->groupBy('ParentID')->limit('10')->get();

            $t = '';
            $usr = new User();
            $default_root_1 = 'https://www.connecting-one.com/Male_default.png';
            $default_root_ = 'https://www.connecting-one.com/';
            if (isset($cm_id)) {
                foreach ($cm_id as $cmsn) {
                    $gPImg_TmlnID = $usr::select('profile_pic', 'timeline_id')->where('id', $cmsn->UserID)->get()->first();
                    $q_un = Timeline::select('fname', 'lname', 'id')->where('id', $gPImg_TmlnID->timeline_id)->get()->first();
                    $t = $t . '<li class="earn-item">';
                    $t = $t . '<div class="earn_img">';

                    if (empty($gPImg_TmlnID->profile_pic))
                        $t = $t . "<img src='$default_root_1'/>";
                    else
                        $t = $t . "<img src='$default_root_$gPImg_TmlnID->profile_pic'/>";
                    $t = $t . '</div>';
                    $t = $t . '<div class="earn_txtblock">';
                    if ($q_un->id != $user->id)
                        $t = $t . '<a class="earn_txtname" href="' . $default_root_ . 'friend?search=' . $q_un->id . '">' . $q_un->fname . ' ' . $q_un->lname . '</a>';
                    else
                        $t = $t . '<a class="earn_txtname" href="' . $default_root_ . 'my-profile">' . $q_un->fname . ' ' . $q_un->lname . '</a>';
                    $t = $t . '<div class="earn_money"><i class="mdi mdi-currency-inr"></i>' . $cmsn->Commission . '</div>';
                    $t = $t . '</div>';
                    $t = $t . '</li>';
                }
            }

            $chat = '{
    "-L87lgDCTEOWTili-Q4F": {
        "message": "😬😁😃😄",
        "time": "Wed, 21 Mar 2018, 7:06 PM",
        "user": "4"
    },
    "-L87nBNN20OmldJy_JMF": {
        "message": "dh🙂😌😌🙃🙃😋🙂",
        "time": "Wed, 21 Mar 2018, 7:13 PM",
        "user": "4"
    },
    "-L87s0GB2hNubbqlAI8A": {
        "message": "dff",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    "-L87s1ZJl7phUEEEm56O": {
        "message": "dvfzsdv",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    
    
    
    "-L87s37wFVrDg5hn1L-B": {
        "message": "dvzSDvv",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    "-L87s44o6zxur12azwhI": {
        "message": "SZDsZXvSV",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    "-L87s4ogzmhQ6fV_GzM8": {
        "message": "zvzZvcv",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    "-L87s8AZ4NYy32-h10xc": {
        "message": "😬😁😃😝😒😒🙄😐😑😜🚋🚟🚊🚃🚜🚡",
        "time": "Wed, 21 Mar 2018, 7:34 PM",
        "user": "4"
    },
    "-L87sJ3Z3-2jb60eLcny": {
        "message": "xd",
        "time": "Wed, 21 Mar 2018, 7:35 PM",
        "user": "4"
    },
    "-L87sNtw3yFQE46dO5va": {
        "message": "dfg",
        "time": "Wed, 21 Mar 2018, 7:36 PM",
        "user": "4"
    },
    "-L87sVyBspeNLtaveLHZ": {
        "message": "ttgg",
        "time": "Wed, 21 Mar 2018, 7:36 PM",
        "user": "4"
    },
    "-L87sXgofS-hGfKFTW3W": {
        "message": "xff",
        "time": "Wed, 21 Mar 2018, 7:36 PM",
        "user": "4"
    },
    "-L87tR9b_kEERYnqb2AE": {
        "message": "xx",
        "time": "Wed, 21 Mar 2018, 7:40 PM",
        "user": "4"
    },
    "-L87tnz_RufeW_n2G1BC": {
        "message": "ses",
        "time": "Wed, 21 Mar 2018, 7:42 PM",
        "user": "4"
    },
    "-L87u7sTSQhC1DDEufaT": {
        "message": "ggg",
        "time": "Wed, 21 Mar 2018, 7:43 PM",
        "user": "4"
    },
    "-L87uk2-2lU7MpV-DeGo": {
        "message": "ddfsd",
        "time": "Wed, 21 Mar 2018, 7:46 PM",
        "user": "4"
    },
    "-L87unWWQ-wJ0WipkIQM": {
        "message": "xcvz",
        "time": "Wed, 21 Mar 2018, 7:46 PM",
        "user": "4"
    },
    "-L8HD3kxaQECxMvr_H7q": {
        "message": "d😜😝😒😏😙☺f",
        "time": "Fri, 23 Mar 2018, 3:07 PM",
        "user": "4"
    },
    "-L8HD5YhLDFuoNRMuz-l": {
        "message": "😁😜😜",
        "time": "Fri, 23 Mar 2018, 3:07 PM",
        "user": "4"
    },
    "-L8XMsdcQ54EqmQv3X-T": {
        "message": "ddg",
        "time": "Mon, 26 Mar 2018, 6:24 PM",
        "user": "4"
    },
    "-L8XnOVSwk-GXv2m88Dp": {
        "message": "hi",
        "time": "Mon, 26 Mar 2018, 8:24 PM",
        "user": "4"
    },
    "-L8XrGYdcGaEjUH4P8kl": {
        "message": "hi",
        "time": "Mon, 26 Mar 2018, 8:41 PM",
        "user": "4"
    },
    "-L8XteGsvaP4xX8BNfNs": {
        "message": "hijhdv",
        "time": "Mon, 26 Mar 2018, 8:51 PM",
        "user": "4"
    },
    "-L8Xtju6z4LPt2NMeNBi": {
        "message": "☺",
        "time": "Mon, 26 Mar 2018, 8:52 PM",
        "user": "4"
    }
}';

            $cats = AdCategory::GetCategoryDropdown();
            $admin_ads = AdminAds::GetPopAds();
            $ad_category = AdCategory::get();
            $notification = Notification::where(['is_active' => 1])->first();

            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id) or u.id in (select f.user_id from friends f where f.friend_id=$user->id)");
            $homeslider = AdminAds::where(['is_active' => 1, 'is_slider' => 1])->get();
            return view('profile.dashboard')->with(['user' => $user, 'timeline' => $timeline, 'top10earners_list' => $t, 'ad_category' => $ad_category, 'friendlist' => $friendlist, 'chat' => $chat, 'homeslider' => $homeslider, 'admin_ads' => $admin_ads, 'notification' => $notification]);
            // End
        }
        return redirect('/');
    }

    public
    function profileImage(Request $request)
    {
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = "profile/" . $image_name;
        file_put_contents($path, $data);

        $user_ses = $_SESSION['user_master'];
        $destination_path = 'profile/';
        $user = UserModel::find($user_ses->id);
        $user->profile_pic = $destination_path . $image_name;
        $user->save();
        return response()->json(['success' => 'done']);
    }


    public
    function profileupdate(Request $request)
    {
//            echo $request->file('profile_pic');
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserModel::find($user_ses->id);
            $timeline = Timeline::find($user->timeline_id);
            $timeline->name = request('fname') . " " . request('lname');
            $timeline->fname = request('fname');
            $timeline->lname = request('lname');
            $timeline->save();


            $user->timeline_id = $timeline->id;
            $user->birthday = Carbon::parse(request('dob'))->format('Y-m-d');
            $user->city = request('city');
            $user->country_id = request('country');
            $user->profession = request('profession');
            if (request('profession') == 'otr')
                $user->profession_other = request('other');
            $user->address = request('address');
//            $file = $request->file('profile_pic');
//            if ($request->file('profile_pic') != null) {
//                $destination_path = 'profile/';
//                $filename = str_random(6) . '_' . $file->getClientOriginalName();
//                $file->move($destination_path, $filename);
//                $user->profile_pic = $destination_path . $filename;
//            }
            $user->save();
            return redirect('dashboard')->with('message', 'Profile has been updated...!');
        } else {
            return redirect('/')->withInput()->withErrors(array('message' => 'Session Invalid'));
        }

//        echo json_encode($user);
    }
}

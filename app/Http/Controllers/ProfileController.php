<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\Ads;
use App\com;
use App\Country;
use App\Friend;
use App\relation;
use App\Timeline;
use App\UserModel;
use App\UserNotifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class ProfileController extends Controller
{

    public function index()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);

            // Get Total Earnings By Id
            $com = new com();
            $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $user->id)->get();
            // Sum up all earnings
            $total = 0;
            foreach ($getTotalEarningsByPID as $Ttl) {
                $total = $total + $Ttl->Com;
            }

            $rltn = new relation();

            $getMembersCount = $rltn::select('id')->where('parent_id', $user->rc)->count();

            $friend_count = Friend::whereRaw("(user_id = $user->id or friend_id = $user->id) and (status = 'friends')")->count();

            return view('profile.my_profile')->with(['user' => $user, 'timeline' => $timeline, 'member_count' => $getMembersCount, 'friend_count' => $friend_count, 'total_earning' => $total]);
        }
        return redirect('/');
    }

    public function edit()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $country = Country::getCountry();
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
            return view('profile.edit_profile')->with(['user' => $user, 'timeline' => $timeline, 'country' => $country]);
        }
        return redirect('/');
    }

    public function updateprofile(Request $request)
    {
//        $file = request('avatar_id');
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserModel::find($_SESSION['user_master']->id);
            $timeline = Timeline::find($user->timeline_id);
            $timeline->name = request('fname') . " " . request('lname');
            $timeline->fname = request('fname');
            $timeline->lname = request('lname');
            $timeline->save();

//            $user = UserModel::where(['timeline_id' => $timeline->id])->first();
            $user->birthday = Carbon::parse(request('dob'))->format('Y-m-d');
            $user->city = request('city');
            $user->country_id = request('country');
            $user->profession = request('profession');
            $user->gender = request('gender_radio');
            $user->profession_other = request('profession_other');
            $user->address = request('address');
            $file = $request->file('profile_pic');
            if ($request->file('profile_pic') != null) {
                $destination_path = 'profile/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $file->move($destination_path, $filename);
                $user->profile_pic = $destination_path . $filename;
            }
            $user->save();
            return redirect('myprofile')->with('message', 'Profile has been updated...!');
        }
        return redirect('/');
    }

    public function change_theme(Request $request)
    {
        $user = $_SESSION['user_master'];
        $user_master = UserModel::find($user->id);
        $user_master->header_colour = request('user_header');

        $file = $request->file('profilebg_Image');
        if ($request->file('profilebg_Image') != null) {
            $destination_path = 'theme/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $user_master->theme_img = $destination_path . $filename;
        } else {
            if (request('theme_img') != null && request('theme_img') != 'images/NoPreview_Img.png') {
                $user_master->theme_img = request('theme_img');
            } else {
                $user_master->theme_img = null;
            }
        }

        $user_master->save();
        $result = array();
        $result = ['header_colour' => $user_master->header_colour,
            'theme_img' => $user_master->theme_img];
        return json_encode($result);
//        echo "header:" . $request->input('user_header');
//        echo "Theme:" . $request->file('profilebg_Image');
//        echo "Theme:" . request('profilebg_Image');
    }

    public function getAllUser(Request $request, $id)
    {
        $items = Timeline::getUser($request->term, $id);
        return response()->json($items);
    }

    public function search_friend()
    {
        if (isset($_SESSION['user_master'])) {
            /*Existing User*/
            if (request('search') != '') {
                $user = $_SESSION['user_master'];
                $timeline = Timeline::find($user->timeline_id);
                /*Existing User*/
                $suser = UserModel::find(request('search'));
                $stimeline = Timeline::find($suser->timeline_id);
                $friendrequest = Friend::where(['user_id' => $user->id, 'friend_id' => request('search')])->orWhere(['user_id' => request('search'), 'friend_id' => $user->id])->first();

                $fid = request('search');
                $friend = DB::select("select f.status as status from friends f where (f.user_id = $user->id and f.friend_id = $fid or f.user_id = $fid and f.friend_id = $user->id)");

                $com = new com();
                $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $fid)->get();
                // Sum up all earnings
                $total = 0;
                foreach ($getTotalEarningsByPID as $Ttl) {
                    $total = $total + $Ttl->Com;
                }
                $rltn = new relation();
                $getMembersCount = $rltn::select('id')->where('parent_id', $suser->rc)->count();
                $friend_count = Friend::whereRaw("(user_id = $suser->id or friend_id = $suser->id) and (status = 'friends')")->count();
                if ($friend != null) {
                    if ($friend[0]->status == 'pending') {
                        $queryResult = DB::select("call GetFriendType($user->id,$fid)");
                        $result = collect($queryResult);
                        return view('profile.user_profile')->with(['search_user' => $suser, 'stimeline' => $stimeline, 'user' => $user, 'timeline' => $timeline, 'friendrequest' => $result[0]->status_, 'member_count' => $getMembersCount, 'friend_count' => $friend_count, 'total_earning' => $total]);
                    } else {
                        $ret['status_'] = $friend[0]->status;
                        return view('profile.user_profile')->with(['search_user' => $suser, 'stimeline' => $stimeline, 'user' => $user, 'timeline' => $timeline, 'friendrequest' => $friend[0]->status, 'member_count' => $getMembersCount, 'friend_count' => $friend_count, 'total_earning' => $total]);
                    }
                } else {
                    $ret['status_'] = null;
//                echo json_encode($ret);
                    return view('profile.user_profile')->with(['search_user' => $suser, 'stimeline' => $stimeline, 'user' => $user, 'timeline' => $timeline, 'friendrequest' => null, 'member_count' => $getMembersCount, 'friend_count' => $friend_count, 'total_earning' => $total]);
                }
            } else {
                return redirect('/dashboard');
            }
        }
        return redirect('/');
    }

    public function sendrequest()
    {
        $user = $_SESSION['user_master'];
        $friend = new Friend();
        $friend->user_id = $user->id;
        $friend->friend_id = request('search_user_id');
        $friend->status = 'pending';
        $friend->save();
//        echo request('user_header');
    }

    public function acceptrequest()
    {
        $friend = Friend::find(request('requestid'));
        $friend->status = 'friends';
        $friend->save();
        echo "Friends";
    }

    public function acceptfrequest()
    {
        $user = $_SESSION['user_master'];
        $friend = Friend::where(['user_id' => request('search_user_id'), 'friend_id' => $user->id])->first();
        $friend->status = 'friends';
        $friend->save();
        echo "Friends";
    }

    public function rejectrequest()  ////by user sent request option -> accept/reject
    {
        $friend = Friend::find(request('requestid'));
        $friend->delete();
        echo "Request removed";
    }

    public function cancelrequest() ////by user send/cancel button
    {
        $user = $_SESSION['user_master'];
        $friend = Friend::where(['user_id' => $user->id, 'friend_id' => request('search_user_id'), 'status' => 'pending'])->delete();
    }

    public function requestlist()//By Website
    {
        if (isset($_SESSION['user_master'])) {
            $user = $_SESSION['user_master'];
            $friends = Friend::where(['friend_id' => $user->id, 'status' => 'pending'])->get();
            return view('profile.request_list')->with(['friends' => $friends]);
        }
    }

    public function notificationlist()//By Website
    {
        if (isset($_SESSION['user_master'])) {
            $user = $_SESSION['user_master'];
//            $notifications = UserNotifications::where(['user_id' => $user->id])->get();
            $unread_notifications = UserNotifications::where(['user_id' => $user->id, 'seen' => 0])->get();
            $notifications = UserNotifications::where(['user_id' => $user->id])->orderBy('id','desc')->get();
            return view('profile.notificationlist')->with(['notifications' => $notifications, 'unread_notifications' => $unread_notifications]);
        }
    }

    public function messagelist()//By Website
    {
        if (isset($_SESSION['user_master'])) {
            $user = $_SESSION['user_master'];
            $friendrqst = Friend::where(['friend_id' => $user->id, 'status' => 'pending'])->get();
            return view('profile.message_list')->with(['friendrqst' => $friendrqst]);
        }
    }

    public function unfriend() ////by user send/cancel button
    {
        $user_id = request('user_id');
        $friend_id = request('friend_id');
        $friend = DB::select("select f.id, f.status as status from friends f where (f.user_id = $user_id and f.friend_id = $friend_id or f.user_id = $friend_id and f.friend_id = $user_id)");
        if ($friend != null) {
            $f = Friend::find($friend[0]->id);
            $f->delete();
            echo 'unfriend';
        } else {
            echo 'No record available';
        }
    }

    public function getsfriend()
    {
        $s = request('search_name');
        $user = DB::select("SELECT u.id, t.name, u.profile_pic FROM users u, timelines t WHERE u.timeline_id = t.id  and t.name LIKE '$s%' and u.active = 1");
        return json_encode($user);
    }


    public function getprivacy_setting()
    {
        if (isset($_SESSION['user_master'])) {
            $user = UserModel::find($_SESSION['user_master']->id);
            return view('profile.privacy_setting')->with(['user' => $user]);
        }
    }

    public function saveprivacy_setting()
    {
        if (isset($_SESSION['user_master'])) {
            $user = UserModel::find($_SESSION['user_master']->id);
            $user->contact_privacy = request('contact_privacy');
            $user->save();
            return redirect('dashboard')->with('message', 'Privacy setting has been updated...!');
        }
    }
}
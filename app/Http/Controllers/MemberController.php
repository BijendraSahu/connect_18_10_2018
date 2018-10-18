<?php

namespace App\Http\Controllers;

use App\com;
use App\Friend;
use App\relation;
use App\Timeline;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class MemberController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
            $friendrequest = Friend::where(['user_id' => $user->id, 'status' => 'friends'])->orWhere(['friend_id' => $user->id, 'status' => 'friends'])->get();

//            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user_id) or u.id in (select f.user_id from friends f where f.friend_id=$user_id)");

            $friendlist = DB::select("select  u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$user->id and status = 'friends')");


            $friend_count = count($friendlist);
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


            return view('member.all_member')->with(['user' => $user, 'timeline' => $timeline, 'friendlist' => $friendlist, 'total_earning' => $total, 'friend_count' => $friend_count, 'getMembersCount' => $getMembersCount]);
        }
        return redirect('/');
    }

    public function friendmember($fid)
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
            $suser = UserModel::find($fid);
            $stimeline = Timeline::find($suser->timeline_id);
            $friendrequest = Friend::where(['user_id' => $fid, 'status' => 'friends'])->orWhere(['friend_id' => $fid, 'status' => 'friends'])->get();

//            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user_id) or u.id in (select f.user_id from friends f where f.friend_id=$user_id)");
            $friendlist = DB::select("select  u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$fid and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$fid and status = 'friends')");
            // Get Total Earnings By Id
            $com = new com();
            $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $fid)->get();
            // Sum up all earnings
            $total = 0;
            foreach ($getTotalEarningsByPID as $Ttl) {
                $total = $total + $Ttl->Com;
            }


            $rltn = new relation();

            $getMembersCount = $rltn::select('id')->where('parent_id', $suser->rc)->count();

            $friend_count = count($friendlist);

            return view('member.friend_member')->with(['user' => $user, 'timeline' => $timeline, 'suser' => $suser, 'stimeline' => $stimeline, 'friendlist' => $friendlist, 'total_earning' => $total, 'friend_count' => $friend_count, 'getMembersCount' => $getMembersCount]);
        }
        return redirect('/');
    }

    public function member_profession($slug)
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
//            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$user->id and status = 'friends') and u.profession like '%$slug%'");

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

            if ($slug != 'Others')
                $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id != $user->id and u.profession LIKE '%$slug%'");
            else
                $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id != $user->id and u.profession LIKE '%Other%'");
            return view('member.profession_member')->with(['user' => $user, 'timeline' => $timeline, 'friendlist' => $friendlist, 'total_earning' => $total, 'friend_count' => $friend_count, 'getMembersCount' => $getMembersCount]);
        }
        return redirect('/');
    }

}

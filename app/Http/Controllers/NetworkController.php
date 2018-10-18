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

class NetworkController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $rltn = new relation();
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

            $friendlist = DB::select("select  u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$user->id and status = 'friends')");


            $friend_count = count($friendlist);

            $getMembersCount = $rltn::select('id')->where('parent_id', $user->rc)->count();
            $lbl = ' Member';
            if ($getMembersCount > 1)
                $lbl = ' Members';
            $_SESSION['level'] = 0;

            return view('network.my_network')->with(['user' => $user, 'timeline' => $timeline, 'amnt' => $total, 'friend_count' => $friend_count, 'MembersCount' => $getMembersCount . $lbl]);
        }
        return redirect('/');
    }

    public function subchild($id)
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $rltn = new relation();
            $timeline = Timeline::find($user_ses->timeline_id);
            $user = UserModel::find($user_ses->id);
            $suser = UserModel::find($id);
            // Get Total Earnings By Id
            $com = new com();
            $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $user->id)->get();
            // Sum up all earnings
            $total = 0;
            foreach ($getTotalEarningsByPID as $Ttl) {
                $total = $total + $Ttl->Com;
            }

            $friendlist = DB::select("select  u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$user->id and status = 'friends')");
            $friend_count = count($friendlist);

            $getMembersCount = $rltn::select('id')->where('parent_id', $user->rc)->count();
            $lbl = ' Member';
            if ($getMembersCount > 1)
                $lbl = ' Members';

            $level_count = com::whereRaw("ParentID = $user->id")->count();

            $child_level = ($_SESSION['level'] < $level_count) ? $_SESSION['level'] + 1 : $level_count;
            $_SESSION['level'] = $child_level;
            return view('network.user_network')->with(['user' => $user, 'suser' => $suser, 'timeline' => $timeline, 'amnt' => $total, 'friend_count' => $friend_count, 'MembersCount' => $getMembersCount . $lbl, 'child_level' => $child_level]);
        }
        return redirect('/');
    }

    //
    public function loadchilds(Request $request)
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $user = UserModel::find($user_ses->id);
            // Id to get records
            $ini_id = request('a');
            $lst_usr_id = 0;
            // Get childs by ParentID from relation table
            $rltn = new relation();
            // Get User Referral ID by User ID
            // Timeline ID and autogen ID is same.
            $getPrntRfrlID = $user::select('rc')->where('id', $user->id)->get();
//            $getChildsByParentID = $rltn::select('child_id', 'id')->where('parent_id', $getPrntRfrlID[0]->rc)->limit(1)->get();
            $getPrntRfrlIDrc = $getPrntRfrlID[0]->rc;
            $getChildsByParentID = DB::select("select child_id, id from relations where parent_id = '$getPrntRfrlIDrc'");
            // Variable to create dynamic template
            $t = '';
            $tmln = new Timeline();
            // Loop records
            $default_root = 'https://www.connecting-one.com/';
            foreach ($getChildsByParentID as $chlds) {
                // child_id is user id, Get User Details by child_id
                //$getUserDetailsByID  =  $user::select('email','contact')->where('id', $chlds->child_id)->get();
                $network_user = UserModel::find($chlds->child_id);
                $getUserDetailsByID = $tmln::select('fname', 'lname', 'avatar_id')->where('id', $network_user->timeline_id)->get();

                $t = $t . '<div class="col-sm-3">';
                $t = $t . '<div class="network_user_block" onclick="location.href=\'' . $default_root . 'subchild/' . $chlds->child_id . '\';" onmouseover="Dynamic_AddClass(this);" onmouseleave="MouseOut(this);">';
                $t = $t . '<div class="connected_imgbox"><img src="' . $default_root . $network_user->profile_pic . '"></div>';
                $t = $t . '<div class="connected_name">' . $getUserDetailsByID[0]->fname . ' ' . $getUserDetailsByID[0]->lname . '</div>';
                $t = $t . '<div class="connected_totalmember">';
                $t = $t . '<i class="mdi mdi-account-multiple"></i>';

                // count members
                $getParentReferalID = $user::select('rc')->where('id', $chlds->child_id)->get();
                $getMembersCount = $rltn::select('id')->where('parent_id', $getParentReferalID[0]->rc)->count();

                $t = $t . $getMembersCount . ' Members';
                $t = $t . '</div>';
                $t = $t . '<div class="network_hover_block">';
                $only5Members = $getMembersCount;
                if ($only5Members > 5)
                    $only5Members = 5;
                for ($m = 0; $m < $only5Members; $m = $m + 1) {
                    $t = $t . '<div class="hover_imgbox top_member' . ($m + 1) . '">';
                    if ($getUserDetailsByID[0]->avatar_id)
                        $t = $t . '<img src="' . $default_root . 'images/' . $getUserDetailsByID[0]->avatar_id . '" />'; ///Remove Code  $getUserDetailsByID[0]->avatar_id
                    else
                        $t = $t . '<img src="' . $default_root . 'images/Male_default.png" />';
                    $t = $t . '</div>';
                }

                $t = $t . '<div class="network_topcaption top_member_caption">Showing ' . $only5Members . '  of Top 5 Members</div>';
                $t = $t . '</div>';
                $t = $t . '<div class="overlay_topmember"></div>';
                $t = $t . '</div>';
                $t = $t . '</div>';
                // Last user id
                $lst_usr_id = $chlds->id;
            }
            return response()->json(array('t' => $t, 'id' => $lst_usr_id));
        }
        return redirect('/');

    }

    public function loadsubchilds(Request $request)
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];

            $user = UserModel::find($user_ses->id);
            $suser = UserModel::find(request('child_id'));
            // Id to get records
            $ini_id = request('a');
            $lst_usr_id = 0;
            // Get childs by ParentID from relation table
            $rltn = new relation();
            // Get User Referral ID by User ID
            // Timeline ID and autogen ID is same.
            $getPrntRfrlID = $suser::select('rc')->where('id', $suser->id)->get();
            $getChildsByParentID = $rltn::select('child_id', 'id')->where('parent_id', $getPrntRfrlID[0]->rc)->limit(100)->get();
            // Variable to create dynamic template
            $t = '';
            $tmln = new Timeline();
            // Loop records
            $default_root = "https://www.connecting-one.com/";
            foreach ($getChildsByParentID as $chlds) {

                $network_user = UserModel::find($chlds->child_id);
                // child_id is user id, Get User Details by child_id
                //$getUserDetailsByID  =  $suser::select('email','contact')->where('id', $chlds->child_id)->get();
                $getUserDetailsByID = $tmln::select('fname', 'lname', 'avatar_id')->where('id', $network_user->timeline_id)->get();

                $t = $t . '<div class="col-sm-3">';
                $t = $t . '<div class="network_user_block" onclick="location.href=\'' . $default_root . 'subchild/' . $chlds->child_id . '\';" onmouseover="Dynamic_AddClass(this);" onmouseleave="MouseOut(this);">';
                $t = $t . '<div class="connected_imgbox"><img src="' . $default_root . $network_user->profile_pic . '"></div>';
                $t = $t . '<div class="connected_name">' . $getUserDetailsByID[0]->fname . ' ' . $getUserDetailsByID[0]->lname . '</div>';
                $t = $t . '<div class="connected_totalmember">';
                $t = $t . '<i class="mdi mdi-account-multiple"></i>';
                $t = $t . '<input class="hidden" value="0" name="child_level"/>';

                // count members
                $getParentReferalID = $suser::select('rc')->where('id', $chlds->child_id)->get();
                $getMembersCount = $rltn::select('id')->where('parent_id', $getParentReferalID[0]->rc)->count();

                $t = $t . $getMembersCount . ' Members';
                $t = $t . '</div>';
                $t = $t . '<div class="network_hover_block">';
                $only5Members = $getMembersCount;
                if ($only5Members > 5)
                    $only5Members = 5;
                for ($m = 0; $m < $only5Members; $m = $m + 1) {
                    $t = $t . '<div class="hover_imgbox top_member' . ($m + 1) . '">';
                    if ($getUserDetailsByID[0]->avatar_id)
                        $t = $t . '<img src="' . $default_root . 'images/' . $network_user->profile_pic . '" />';
                    else
                        $t = $t . '<img src="' . $default_root . 'images/Male_default.png" />';
                    $t = $t . '</div>';
                }

                $t = $t . '<div class="network_topcaption top_member_caption">Showing ' . $only5Members . '  of Top 5 Members</div>';
                $t = $t . '</div>';
                $t = $t . '<div class="overlay_topmember"></div>';
                $t = $t . '</div>';
                $t = $t . '</div>';
                // Last user id
                $lst_usr_id = $chlds->id;
            }

            return response()->json(array('t' => $t, 'id' => $lst_usr_id));
        }
        return redirect('/');

    }


    public function verifyReferralCode()
    {
        $rc = request('a');
        $user = $_SESSION['user_master'];
        $userDetails = $user::select('id', 'timeline_id', 'profile_pic', 'contact',
            'city')->where('rc', $rc)->get()->first();
        if (isset($userDetails)) {
            $tmln = new Timeline();
            $ud = $tmln::select('fname', 'lname')->where('id', $userDetails->timeline_id)->get()->first();
            return response()->json(array('t' => true, 'f' => $ud->fname, 'l' => $ud->lname, 'p' => $userDetails->profile_pic, 'm' => $userDetails->contact, 'c' => $userDetails->city));
        }
        return response()->json(array('t' => false));
    }

    public function getMembersToCreateNetwork()
    {
        // Free Members
        $rltn = new relation();
        $userID = $_SESSION['user_master']["id"];
        $userRC = $_SESSION['user_master']["rc"];
        /////////////NON PAID REFERAL
        $getMembers = $rltn::select('child_id')->where('parent_id', $userRC)->where('PaymentStatus', '0')->where('child_id', '!=', $userID)->get();
        $t = '';
        $user = new UserModel();
        $tmln = new Timeline();
        $condition = '';
        $default_root_1 = 'https://www.connecting-one.com/Male_default.png';
        $default_root_ = 'https://www.connecting-one.com/';
        if (count($getMembers) > 0) {
            foreach ($getMembers as $chlds) {
                $ud = $user::select('profile_pic', 'timeline_id')->where('id', $chlds->child_id)->first();
                $u_fln = $tmln::select('fname', 'lname')->where('id', $ud->timeline_id)->get()->first();
                $condition = $condition . '["child_id"' . '!="26"]';
                $t = $t . '<div class="col-sm-3  col-xs-6 add_user_block">';
                $t = $t . '<div class="network_user_block">';
                /////////////// Image
                $t = $t . '<div class="connected_imgbox current_hover_img">';
                $t = $t . '<img src="' . $default_root_ . $ud->profile_pic . '">';
                $t = $t . '</div>';
                /////////////// Name
                $t = $t . '<div class="connected_name">';
                $t = $t . $u_fln->fname . " " . $u_fln->lname;
                $t = $t . '</div>';
                ///////////////
                /////////////// Request Button
                $t = $t . '<div class="Request_btn"><a style="color:#fff;" href="' . $default_root_ . 'friend?search=' . $chlds->child_id . '">Connect</a></div>';
                ///////////////
                $t = $t . '</div>';
                $t = $t . '</div>';

            }
        }
        /////////////NON PAID REFERAL Ends here

        /////////////Random REFERAL
        $getMember = $rltn::select('child_id')->where('child_id', '!=', $userID)->get();
        $r = '';
        $user = new UserModel();
        $tmln = new Timeline();
        if (count($getMember) > 0) {
            foreach ($getMember as $chlds) {
                $ud = $user::select('profile_pic', 'timeline_id')->where('id', $chlds->child_id)->get()->first();
                if (isset($ud->timeline_id)) {
                    $u_fln = $tmln::select('fname', 'lname')->where('id', $ud->timeline_id)->get()->first();
                    $r = $r . '<div class="col-sm-3 add_user_block col-xs-6">';
                    $r = $r . '<div class="network_user_block">';
                    /////////////// Image
                    $r = $r . '<div class="connected_imgbox current_hover_img">';
                    $r = $r . '<img src="' . $ud->profile_pic . '">';
                    $r = $r . '</div>';
                    /////////////// Name
                    $r = $r . '<div class="connected_name">';
                    $r = $r . $u_fln->fname . " " . $u_fln->lname;
                    $r = $r . '</div>';
                    ///////////////
                    /////////////// Request Button
                    $r = $r . '<div class="Request_btn"><a style="color:#fff;" href="' . $default_root_ . 'friend?search=' . $chlds->child_id . '">Connect</a></div>';
                    ///////////////
                    $r = $r . '</div>';
                    $r = $r . '</div>';
                }
            }
        }
        /////////////NON PAID REFERAL Ends here

        return response()->json(array('t' => $t, 'r' => $r));

        //###################


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $file = request('avatar_id');
//        echo $file;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

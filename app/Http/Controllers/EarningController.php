<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Timeline;
use App\com;
use App\redeem_master;
use App\user_bank_detail;
use App\relation;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class EarningController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_master'])) {
            $suser = $_SESSION['user_master'];
            $timeline = Timeline::find($suser->timeline_id);
            $user = UserModel::find($suser->id);
            $rltn = new relation();
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
            return view('earning.my_earning')->with(['user' => $user, 'timeline' => $timeline, 'amnt' => $total, 'friend_count' => $friend_count, 'MembersCount' => $getMembersCount . $lbl]);
        }
        return redirect('/');
    }

    public function addBankDetailsToRedeem()
    {
        $ahName = request('a');
        $ah_no = request('b');
        $ah_bnk = request('c');
        $ah_ifs = request('d');
        $ah_amt = request('e');
        $ah_adhr = request('f');
        $is_future = request('g');
        if (request('a') != null) {
            $ubd = new user_bank_detail();

            $uad = $ubd::select('id')->where('user_id', $_SESSION['user_master']['id'])->where('ac_number', $ah_no)->get()->first();
            if (empty($uad->id)) {
                $add_details = array('account_holder' => $ahName, 'ac_number' => $ah_no, 'bank' => $ah_bnk, 'ifsc_code' => $ah_ifs, 'aadhar_pan' => $ah_adhr, 'is_future_use' => $is_future, 'user_id' => $_SESSION['user_master']['id']);
                DB::table('user_bank_details')->insert($add_details);
            }
            // add amount
            $add_amount = array('ac_number' => $ah_no, 'amount' => $ah_amt, 'user_id' => $_SESSION['user_master']['id']);
            DB::table('redeem_masters')->insert($add_amount);
            ////////////
            return response()->json(array('s' => '1', 't' => 'Details added Successfully'));
        }

    }

    public function getUserAccountDetails()
    {
        $rdm = new user_bank_detail();
        $uad = $rdm::select('id', 'account_holder', 'ac_number', 'bank', 'ifsc_code', 'aadhar_pan')->where('user_id', $_SESSION['user_master']['id'])->where('is_future_use', 1)->get();
        $t = '';
        foreach ($uad as $dtls) {
            $t = $t . '<div class="account_exist" onclick="ShowPrevAccDetails(this);">' . $dtls->ac_number;
            $t = $t . '<input type="hidden" class="hidden_acc_name" value="' . $dtls->account_holder . '"/>';
            $t = $t . '<input type="hidden" class="hidden_acc_no" value="' . $dtls->ac_number . '"/>';
            $t = $t . '<input type="hidden" class="hidden_acc_bank" value="' . $dtls->bank . '"/>';
            $t = $t . '<input type="hidden" class="hidden_acc_ifs" value="' . $dtls->ifsc_code . '"/>';
            $t = $t . '<input type="hidden" class="hidden_acc_adhr" value="' . $dtls->aadhar_pan . '"/>';
            $t = $t . '</div>';

        }
        return $t;
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

    public function getEarnings(Request $request)
    {
        if (isset($_SESSION['user_master'])) {
            $user = $_SESSION['user_master'];
            $timeline = Timeline::find($user->timeline_id);
            $com = new com();

            // Id to get records
            $ini_id = request('a');
            $lst_usr_id = 0;
            // Get childs by ParentID from relation table
            $rltn = new relation();
            // Get User Referral ID by User ID
            // Timeline ID and autogen ID is same.
            $getPrntRfrlID = $user::select('rc')->where('id', $user->id)->get();
            $getChildsByParentID = $rltn::select('child_id', 'id')->where('parent_id', $getPrntRfrlID[0]->rc)->where('id', '>', $ini_id)->get();
            // Variable to create dynamic template
            $t = '';
            $tmln = new Timeline();
            // Loop records
            $default_root = 'https://www.connecting-one.com/';
            foreach ($getChildsByParentID as $chlds) {
                // child_id is user id, Get User Details by child_id
                //$getUserDetailsByID  =  $user::select('email','contact')->where('id', $chlds->child_id)->get();
                $earning_user = UserModel::find($chlds->child_id);
                $getUserDetailsByID = $tmln::select('fname', 'lname', 'avatar_id')->where('id', $earning_user->timeline_id)->get();

                $t = $t . '<div class="col-sm-3 col-xs-6">';
                $t = $t . '<div class="network_user_block" onmouseover="Dynamic_AddClass(this);" onmouseleave="MouseOut(this);">';
                $t = $t . '<div class="connected_imgbox"><img src="' . $default_root . $earning_user->profile_pic . '"></div>';
                $t = $t . '<div class="connected_name">' . $getUserDetailsByID[0]->fname . ' ' . $getUserDetailsByID[0]->lname . '</div>';
                $t = $t . '<div class="connected_totalmember">';
                $t = $t . '<i class="mdi mdi-currency-inr"></i>';

                // count members
                $getParentReferalID = $user::select('rc')->where('id', $chlds->child_id)->get();
                $getMembersCount = $rltn::select('id')->where('parent_id', $getParentReferalID[0]->rc)->count();


                /*
                Network members count on hover removed
                */

                // Get Total Earnings By Id
                $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $chlds->child_id)->get();
                // Sum up all earnings
                $total = 0;
                foreach ($getTotalEarningsByPID as $Ttl) {
                    $total = $total + $Ttl->Com;
                }
                $t = $t . $total;
                $t = $t . '</div>';
                $t = $t . '</div>';
                $t = $t . '</div>';
                // Last user id
                $lst_usr_id = $chlds->id;
            }


            return response()->json(array('t' => $t, 'id' => $lst_usr_id));


        }
        return redirect('/');

    }
}

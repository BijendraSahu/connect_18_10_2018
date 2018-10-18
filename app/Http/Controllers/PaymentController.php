<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;
use App\UserModel;
use App\Country;
use App\relation;
use App\com;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

session_start();

class PaymentController extends Controller
{
    public function paytmTransactionDetails()
    {
        $timeline = new Timeline();
        $user = new UserModel();
        $country = Country::getCountry();
        $rltn = new relation();

        $user_id = $_SESSION['user_master']['id'];
        //////////////////////////
        $transactionStatus = $_SESSION["transaction_status"];
        if ($transactionStatus == 'TXN_SUCCESS') {
            $this->setUserReferralCode($user_id);
            //////////////////////////
            // Check Relation created or not
            $this->makeRelation($user_id);
            // Generate referal code
            $this->generateReferralCode($user_id);
            // add commission
            $this->addComission($user_id);
        }
        $this->resetRcode(); // Reset referal code
        //////////////////
        $total = $this->getTotalEarning();
        $lbl = $this->getMembersCount();

        return $this->redirectBack($total, $lbl); // takes user back

    }

    // PayU Money
    public function atom_payment()
    {
        $timeline = new Timeline();
        $user = new UserModel();
        $country = Country::getCountry();
        $rltn = new relation();

        // Get User ID from session
        $user_id = $_SESSION['user_master']['id'];
        $_SESSION['rcode'] = $_REQUEST['udf4'];
        // If transaction successful
        $status = $_REQUEST["f_code"];
        if ($status != 'F') {
            $this->setUserReferralCode($user_id);
            //////////////////////////
            // Check Relation created or not
            $this->makeRelation($user_id);
            ////
            $this->generateReferralCode($user_id);
            $this->addComission($user_id);

            $u = UserModel::find($user_id);
            $u->member_type = 'paid';
            $u->save();
            return redirect('dashboard')->with('message', "Payment has been successful...Your referral code is $u->rc");
        } else {
            return redirect('dashboard')->withErrors(array('message' => 'Payment has been failed please try again later...!'));
        }
//        $this->resetRcode(); // Reset referal code
//        //////////////////
//        $total = $this->getTotalEarning();
//        $lbl = $this->getMembersCount();
//        return $this->redirectBack($total, $lbl); // takes user back

    }

    function resetRcode()
    {
        $_SESSION['rcode'] = '0';
    }

    function redirectBack($total, $lbl)
    {
        $user = $_SESSION['user_master'];
        $timeline = new Timeline();
        if ($_SESSION["page_id"] == 2)
            return redirect('/my-earning')->with(['user' => $user, 'timeline' => $timeline, 'amnt' => $total, 'MembersCount' => $lbl]);
        else
            return redirect('/my-network')->with(['user' => $user, 'timeline' => $timeline, 'amnt' => $total, 'MembersCount' => $lbl]);
    }

    function setUserReferralCode($user_id)
    {
        $rltn = new relation();
        if ($_SESSION['rcode'] == "0") {
            //Check rc already exists & update likewise
            $rc_from_tbl = $rltn::select('parent_id')->where('child_id', $user_id)->get()->first();
            if ($rc_from_tbl != "0")
                $_SESSION['rcode'] = $rc_from_tbl->parent_id;
            else
                $_SESSION['rcode'] = "0";
        }
    }

    function makeRelation($user_id)
    {
        if ($this->checkRelationExists($user_id) == null) {
            if ($_SESSION['rcode'] != "0")
                $this->createRelation($_SESSION['rcode'], $user_id);
            else
                $this->createRelation(0, $user_id);
        } else {
            // Update Relation Parent ID
            $user_id = $_SESSION['user_master']['id'];

            $ar_rc = array('parent_id' => $_SESSION['rcode']);
            DB::table('relations')->where('child_id', $user_id)->update($ar_rc);
        }
    }

    function getTotalEarning()
    {
        $user = $_SESSION['user_master'];
        $rltn = new relation();
        $timeline = Timeline::find($user->timeline_id);
        // Get Total Earnings By Id
        $com = new com();
        $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $user->id)->get();
        // Sum up all earnings
        $total = 0;
        foreach ($getTotalEarningsByPID as $Ttl) {
            $total = $total + $Ttl->Com;
        }
        return $total;

    }

    function getMembersCount()
    {
        $user = $_SESSION['user_master'];
        $rltn = new relation();
        $getParentReferalID = $user::select('rc')->where('id', $user->id)->get();
        $getMembersCount = $rltn::select('id')->where('parent_id', $getParentReferalID[0]->rc)->count();
        $lbl = ' Member';
        if ($getMembersCount > 1)
            $lbl = ' Members';
        return $getMembersCount . $lbl;
    }

    function checkRelationExists($user_id)
    {
        $rltn = new relation();
        $PrntRfrID = $rltn::select('id')->where('child_id', $user_id)->get()->first();
        if (isset($PrntRfrID->id))
            return true;
        return false;
    }

    function createRelation($rfrcd, $user_id)
    {
        $user = new UserModel();
        // parent_id is referal_id here, Usinf Id as referal_id
        $add_rltns = array('parent_id' => $rfrcd, 'child_id' => $user_id, 'PaymentStatus' => 1);
        DB::table('relations')->insert($add_rltns);
    }

    function generateReferralCode($user_id)
    {
        // Check RC already there
        $user = new UserModel();
        $usrRC = $user::select('rc')->where('id', $user_id)->get()->first();
        if (!isset($usrRC->rc)) {
            $usr_gen_rc = rand(100000, 999999);
            $ar_rc = array('rc' => $usr_gen_rc);
            DB::table('users')->where('id', $user_id)->update($ar_rc);
        }
    }

    function addComission($user_id)
    {
        $rltn = new relation();
        $user = new UserModel();
        $com = new com();
        $cm_id = $com::select('id')->where('SourceID', $user_id)->get()->first();
        if (isset($cm_id))
            return false; // If commission already given
        // Get Parent ID from registered Email ID
        // Parent Id is referral code here
        $parentRfrlCode = $rltn::select('parent_id')->where('child_id', $user_id)->get()->first();
        $referralCode = $parentRfrlCode->parent_id;
        if ($referralCode == "0")
            return false; // User has not used any referral code

        // Commision Starts here... //

//        $amnt = 0.5;
        $amnt = 1.0;
        $cmnsn = 0;

        $ci = 0;
        while (1) {
            // Get Parent/User ID By Referral Code FROM users table
            $userIDByRC = $user::select('id')->where('rc', $referralCode)->get()->first();
            // Exit loop, if no Id From users found
            if (!isset($userIDByRC->id))
                break;
            $userID = $userIDByRC->id;

            // GET ChildID FROM relations by Parent ID from rgs
            $getRfrID = $rltn::select('parent_id')->where('child_id', $userID)->get()->first();

            // Divide each comission part in equal halves (amnt/2)
            $cmsn = $amnt / 2;

            $add_usr_cmsn = array('SourceID' => $user_id, 'ParentID' => $userID, 'Com' => $cmsn);
            DB::table('coms')->insert($add_usr_cmsn);
            $amnt = $cmsn; // assign comission to amount
            if (!isset($getRfrID->parent_id))
                break;
            $referralCode = $getRfrID->parent_id;
        }

    }

//    public function atom_payment(Request $request)
//    {
//        echo json_encode($_REQUEST);
////        return redirect('/dashboard');
////        parent::__call($method, $parameters); // TODO: Change the autogenerated stub
//    }


}

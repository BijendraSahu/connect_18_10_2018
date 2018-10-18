<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\Ads;
use App\redeem_master;
use App\Timeline;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class RedeemController extends Controller
{
    public function redeemhisty()
    {
        if (isset($_SESSION['user_master'])) {
            $user_ses = $_SESSION['user_master'];
            $timeline = Timeline::find($user_ses->timeline_id);
            $ads = Ads::where(['user_id' => $user_ses->id])->get();
            $ad_category = AdCategory::get();
            $user = UserModel::find($user_ses->id);
//            $redeems = redeem_master::GetAllRedeem();
            $redeems = DB::select("SELECT rm.id, rm.ac_number, rm.amount, rm.status, ub.account_holder, ub.bank, ub.aadhar_pan,ub.ifsc_code, rm.created_time FROM redeem_masters rm, user_bank_details ub WHERE rm.ac_number = ub.ac_number and rm.user_id = $user->id");
            return view('redeem.redeem_history')->with(['user' => $user, 'timeline' => $timeline, 'ads' => $ads, 'ad_category' => $ad_category, 'redeems' => $redeems]);
        }
        return redirect('/');
    }
}

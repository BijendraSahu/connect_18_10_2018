<?php

namespace App\Http\Controllers;

use App\AdminAds;
use App\AdminModel;
use App\Ads;
use App\AdsClick;
use App\com;
use App\OrderMaster;
use App\PaytmLink;
use App\Posts;
use App\RcSave;
use App\redeem_master;
use App\relation;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{

    public function getlogin()
    {
        return view('admin.admin_login');
    }

    public function getpaytm()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.paytm_link.view_link')->with(['paytm' => PaytmLink::first(), 'user' => $user]);
    }

    public function editpaytm($id)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.paytm_link.edit_link')->with(['paytm' => PaytmLink::find($id), 'user' => $user]);
    }

    public function savepaytm($id)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $paytm = PaytmLink::find(1);
        $paytm->link = request('link');
        $paytm->save();
        return redirect('getpaytmlist')->with('message', 'Link has been updated...!');
    }

    public function paytm_redirect()
    {
        $paytm = PaytmLink::find(1);
        return redirect("$paytm->link");
    }

    public function login(Request $request)
    {
        $username = request('username');
        $password = request('password');
        $user = AdminModel::where(['is_active' => 1, 'username' => $username, 'password' => md5($password)])->first();
        if ($user != null) {
            $_SESSION['admin_master'] = $user;
//            echo $_SESSION['admin_master'];
            return redirect('home');
        } else
            return Redirect::back()->withInput()->withErrors(array('message' => 'Email or password Invalid'));
    }

    public function home()
    {
        if (isset($_SESSION['admin_master'])) {
            $user_ses = $_SESSION['admin_master'];
            $user = AdminModel::find($user_ses->id);
            return view('admin.admin_dashboard')->with(['user' => $user]);
//            return view('admin.registration_list')->with('regs', UserModel::GetRegs());
        }
        return redirect('/access');
    }

    public function index()////////dashboard
    {
        if (isset($_SESSION['admin_master'])) {
            $user_ses = $_SESSION['admin_master'];
            $user = AdminModel::find($user_ses->id);
            $reg_count = UserModel::count();
            $free_reg_count = UserModel::where(['member_type' => 'free'])->count();
            $paid_reg_count = UserModel::where(['member_type' => 'paid'])->count();
            $pending_ads = Ads::GetPendingAds();
            $redeems = DB::select("SELECT rm.id, rm.ac_number, rm.amount, rm.status, ub.account_holder, ub.bank, ub.aadhar_pan,ub.ifsc_code, rm.created_time FROM redeem_masters rm, user_bank_details ub WHERE rm.ac_number = ub.ac_number ORDER BY rm.id DESC LIMIT 5");
            $com = new com();
            $getTotalEarnings = $com::select('Com')->get();
// Sum up all earnings
            $total = 0;
            foreach ($getTotalEarnings as $Ttl) {
                $total = $total + $Ttl->Com;
            }
//            echo json_encode($total);
            return view('admin.admin_dashboard')->with(['user' => $user, 'reg_count' => $reg_count, 'free_reg_count' => $free_reg_count, 'paid_reg_count' => $paid_reg_count, 'totalearning' => $total, 'pending_ads' => $pending_ads, 'redeems' => $redeems]);
        }
        return redirect('/access');
    }

    public function getAllAds()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.ad_list')->with(['ads' => Ads::GetActiveAdsAdmin(), 'user' => $user]);
    }


    public function admin_profile()
    {
//        echo "hi";
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.edit_admin')->with(['user' => $user]);
    }

    public function admin_profile_edit(Request $request)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $user->name = request('name');
        $user->designation = request('profession');
        $file = $request->file('profile_pic');
        if ($request->file('profile_pic') != null) {
            $destination_path = 'profile/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $user->profile_pic = $destination_path . $filename;
        }
        $user->save();
        return redirect('home')->with(['user' => $user])->with('message', 'Profile has been updated...!');;
    }

//    public function rejectreason($id)
//    {
//
//        return view('admin.reject_reason')->with('id', $id);
//    }

    public function rejectsubmit()
    {
        $id = request('addid');
        $ads = Ads::find($id);
        $ads->status = "Rejected";
        $ads->reject_reason = request('reject_reason');
        $ads->save();
        return redirect('ads')->with('message', 'Ad has been rejected...!');
    }


    public function registrationlist()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.registration_list')->with(['regs' => UserModel::GetRegs(), 'user' => $user]);
    }

    public function view_user($id)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $reg = UserModel::find($id);
        return view('admin.view_details')->with(['reg' => $reg, 'user' => $user]);
    }

    /****************Affiliates list***************/
    public function createAffiliates()
    {
        return view('admin.affiliates.create_affiliates');
    }

    public function save_affiliates()
    {
        $aff_link = request('affiliate_link');
        $add_details = array('affiliate_link' => $aff_link);
        DB::table('affiliates')->insert($add_details);
        return redirect('affiliateslist')->with('message', 'Affiliate has been saved...!');
    }

    public function affiliateslist()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $affiliates = DB::table('affiliates')->get();
//        echo json_encode($affiliates);
        return view('admin.affiliates.view_affiliates')->with(['affiliates' => $affiliates, 'user' => $user]);
    }

    public function deleteAffiliate($id)
    {
        DB::table('affiliates')->where('id', $id)->delete();
        return redirect('affiliateslist')->with('message', 'Affiliate has been deleted...!');
    }

    /****************Affiliates list***************/


    public function saverc()
    {
        $rc = request('rc');
        $user_id = $_SESSION['user_master']->id;
        DB::table('rc_save')->where('user_id', '=', $user_id)->delete();
        $rc_save = new RcSave();
        $rc_save->rc = $rc;
        $rc_save->user_id = $user_id;
        $rc_save->save();
    }


    public function markaspaid($id)
    {
        $user = UserModel::find($id);
        $user->member_type = 'paid';
        $user->save();
        $rc_get = RcSave::where(['user_id' => $id])->first();
        $_SESSION['rcode'] = (isset($rc_get)) ? $rc_get->rc : '0';
        $this->makeRelation($id);
        if (isset($rc_get)) {
            $this->setUserReferralCode($id);
            //////////////////////////
            // Check Relation created or not

            ////
            $this->generateReferralCode($id);
            $this->addComission($id);
            $this->resetRcode(); // Reset referal code
        }
        //DB::table('product_images')->where('product_id', '=', $id)->delete();
        return redirect()->back()->with('message', 'User has been marked as paid...!');
    }

    function resetRcode()
    {
        $_SESSION['rcode'] = '0';
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

    function checkRelationExists($user_id)
    {
        $rltn = new relation();
        $PrntRfrID = $rltn::select('id')->where('child_id', $user_id)->get()->first();
        if (isset($PrntRfrID->id))
            return true;
        return false;
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

            $ar_rc = array('parent_id' => $_SESSION['rcode']);
            DB::table('relations')->where('child_id', $user_id)->update($ar_rc);
        }
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

    /*****Add Commission******/
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

    /*****Add Commission******/

    public function markasunpaid($id)
    {
        $user = UserModel::find($id);
        $user->member_type = 'free';
        $user->save();
//        DB::table('product_images')->where('product_id', '=', $id)->delete();
        return redirect()->back()->with('message', 'User has been marked as free...!');
    }

    public function freeregistrationlist()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.free_registration_list')->with(['regs' => UserModel::GetfreeRegs(), 'user' => $user]);
    }

    public function paidregistrationlist()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.paid_registration_list')->with(['regs' => UserModel::GetpaidRegs(), 'user' => $user]);
    }

    public function clickadslist()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.click_ads_list.clicks_ads')->with(['adsclick' => AdsClick::GetAds(), 'user' => $user]);
    }

    public function redeems()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $redeems = DB::select("SELECT rm.id, rm.ac_number, rm.amount, rm.status, ub.account_holder, ub.bank, ub.aadhar_pan,ub.ifsc_code, rm.created_time FROM redeem_masters rm, user_bank_details ub WHERE rm.ac_number = ub.ac_number ORDER BY rm.id DESC");
        return view('admin.redeem_request')->with(['redeems' => $redeems, 'user' => $user]);
    }

    public function approve($id)
    {
        $Cate = Ads::find($id);
        $Cate->is_approved = 1;
        $Cate->status = 'Approved';
        $Cate->save();
        return redirect('ads')->with('message', 'Ad has been approved...!');
    }

    public function redeem_approve($id)
    {
        $Cate = redeem_master::find($id);
        $Cate->status = 'Approved';
        $Cate->save();
        return redirect('redeems')->with('message', 'Redeem request has been approved...!');
    }

    public function markasactive($id)
    {
        $Cate = UserModel::find($id);
        $Cate->active = '1';
        $Cate->save();
        return redirect('regs')->with('message', 'User has been activated...!');
    }

    public function markasinactive($id)
    {
        $Cate = UserModel::find($id);
        $Cate->active = '0';
        $Cate->save();
        return redirect('regs')->with('message', 'User has been Inactivated...!');
    }

    public function redeem_reject()
    {
        $id = request('redid');
        $ads = redeem_master::find($id);
        $ads->status = "Rejected";
        $ads->reject_reason = request('reject_reason');
        $ads->save();
        return redirect('redeems')->with('message', 'Redeem request has been rejected...!');
    }

    public function change_password()
    {
        $curr_pass = $_SESSION['admin_master']->password;
        if (md5(request('oldpassword')) == $curr_pass) {
//            if (request('newpassword') == request('confirmpassword')) {
            $user = AdminModel::find($_SESSION['admin_master']->id);
            $user->password = md5(request('newpassword'));
            $user->save();
            $_SESSION['user_master'] = $user;
            echo 'ok';
//                return redirect('change_password')->withErrors(array('message' => 'Password changed successfully.'));
//            } else
//                return redirect('change_password')->withInput()->withErrors(array('message' => 'Passwords mismatch'));
        } else
//            return redirect('change_password')->withInput()->withErrors(array('message' => 'Incorrect current password'));
            echo 'Incorrect';
//        return redirect('home')->with('message', 'Password has been changed...!');
    }

    public function orders()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $orders = DB::select("SELECT * FROM order_master order by id desc");
        return view('admin.orders.order_list')->with(['user' => $user, 'orders' => $orders]);
    }

    public function view_orders($oid)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $orders = DB::select("SELECT o.*,od.id as ods_id, od.total, od.qty, od.unit_price, od.item_master_id FROM order_description od, order_master o WHERE od.order_master_id = o.id and od.order_master_id = $oid");
        return view('admin.orders.view_order_item')->with(['user' => $user, 'orders' => $orders]);
    }

    public function order_update($id)
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $orders = OrderMaster::find($id);
        $orders->status = request('status');
        $orders->save();
        return redirect('orders')->with('message', 'Order status has been updated...!');
    }

    /****Report*****/
    public function report_post()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        $posts = DB::select("SELECT * from posts p WHERE p.id in (SELECT post_spam.post_id from post_spam WHERE post_spam.post_id = p.id)");
        return view('admin.report.report_post')->with(['posts' => $posts, 'user' => $user]);
    }

    public function view_report_post()
    {
        $user_ses = $_SESSION['admin_master'];
        $post_by = Posts::find(request('post_id'));
        $admin = AdminModel::find($user_ses->id);
//        $posts = DB::select("SELECT * from posts p WHERE p.id in (SELECT post_spam.post_id from post_spam WHERE post_spam.post_id = p.id)");
//        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find($post_by->posted_by);
        $post_id = request('post_id');
        $user_id = $user->id;
        $posts_ = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where p.id = $post_id and p.user_id=$user_id";
//        echo $s;
        $post = DB::selectOne($posts_);
//echo json_encode($posts);
//        if (count($posts)>0) {
//            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");
//                echo $post->id;
//                echo json_encode($media_re);
//                echo json_encode($comment_re);

                $results[] = ['id' => $user_id, 'description' => isset($post->description) ? $post->description : '', 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
                return view('admin.report.view_report_post')->with(['post' => $results, 'user' => $user, 'count_post' => 1]);
//            }
//        }
    }
    /****Report*****/

}

<?php

namespace App\Http\Controllers;

use App\AdCategory;
use App\AdminModel;
use App\Ads;
use App\AdsImages;
use App\com;
use App\Comments;
use App\Country;
use App\Events\StatusLiked;
use App\Friend;
use App\ItemMaster;
use App\Notification;
use App\OrderDescription;
use App\OrderMaster;
use App\PanicContact;
use App\Post_likes;
use App\Post_media;
use App\Post_spam;
use App\Post_unlikes;
use App\Posts;
use App\RcSave;
use App\redeem_master;
use App\relation;
use App\Timeline;
use App\user_bank_detail;
use App\UserAddress;
use App\UserBankDetails;
use App\UserComm;
use App\UserModel;
use App\UserNotifications;
use Carbon\Carbon;
use ChristofferOK\LaravelEmojiOne\LaravelEmojiOne;
use ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Storage;
use Validator;

class APIController extends Controller
{

    /**************Rest API Function**************/
    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**************Rest API Function**************/

    /*****************Login Credentials*******************/
    public function login()
    {
        $email = request('email');
        $password = md5(request('password'));
        $user = DB::selectOne("select u.id, u.rc, t.fname, t.lname, u.email, u.contact, u.birthday, u.country_id, u.city, u.gender, u.verified, u.otp, u.profile_pic, u.member_type, u.state, u.city, u.address from users u, timelines t where u.timeline_id = t.id and u.email = '$email' and u.password = '$password'");
        if (isset($user)) {
            if (request('token') != null) {
                $user_master = UserModel::find($user->id);
                $user_master->token = request('token');
                $user_master->save();
            }
            $ret['response'] = $user;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'Invalid Credentials';
            echo json_encode($ret);
        }
    }

    public function resend_otp()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserModel::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user->otp = $otp;
            $user->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20OTP%20to%20verify%20your%20connectingone%20account%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20verify%20your%20connectingone%20account%20is%20$otp");

            $ret['response'] = 'Otp has been send to your number';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'Invalid Credentials';
            echo json_encode($ret);
        }
    }

    public function verifyotp()
    {
        $otp = request('otp');
        $user = UserModel::where(['otp' => $otp])->first();
        if (isset($user)) {
            $user->verified = 1;
            $user->save();
            $ret['response'] = 'Your account has been verified';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'Incorrect otp';
            echo json_encode($ret);
        }
    }
    /*****************Login Credentials*******************/

    /*****************friend request/accept/cancel/get*******************/
    public function checkfriend()
    {
        $user_id = request('user_id');
        $friendlist = DB::select("select u.id as fid, u.contact, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user_id and f.status='friends') or u.id in (select f.user_id from friends f where f.friend_id=$user_id and f.status='friends')");
        $ret['response'] = $friendlist;
        $retno['response'] = "no friends";
        if (count($friendlist) > 0)
            echo json_encode($ret);
        else
            echo json_encode($retno);
    }

    public function sendrequest()
    {
        Friend::where(['user_id' => request('user_id'), 'friend_id' => request('friend_id')])->delete();
        $friend = new Friend();
        $friend->user_id = request('user_id');
        $friend->friend_id = request('friend_id');
        $friend->status = 'pending';
        $friend->save();
        $ret['status'] = 'pending';
        echo json_encode($ret);

        /******Notification*******/
        $user_s = UserModel::find(request('user_id'));
        $user_f = UserModel::find(request('friend_id'));
        if (isset($user_f->token)) {
            $request_by = ucwords($user_s->timeline->name);
            $title = "Friend Request";
            $message = "$request_by is send you an friend request";
            $token = $user_f->token;
            $data = $user_f;
            $user_notification = new UserNotifications();
//            $user_notification->post_id = $post->id;
            $user_notification->user_id = $user_f->id;
            $user_notification->notified_by = $user_s->id;
            $user_notification->description = "<b>$request_by</b> is send you an friend request";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
            //event(new StatusLiked($post->posted_by));
            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/

    }

    public function acceptrequest()
    {
        $friend = Friend::where(['user_id' => request('friend_id'), 'friend_id' => request('user_id')])->first();
//        echo json_encode($friend);
//        $friend = Friend::find(request('requestid'));
        $friend->status = 'friends';
        $friend->save();
        $ret['status'] = 'friends';
        echo json_encode($ret);
        /******Notification*******/
        $user_s = UserModel::find(request('user_id'));
        $user_f = UserModel::find(request('friend_id'));
        if (isset($user_s->token)) {
            $request_by = ucwords($user_f->timeline->name);
            $title = "Friend Request Accepted";
            $message = "$request_by has accepted your friend request";
            $token = $user_s->token;
            $data = $user_f;
            $user_notification = new UserNotifications();
//            $user_notification->post_id = $post->id;
            $user_notification->user_id = $user_s->id;
            $user_notification->notified_by = $user_f->id;
            $user_notification->description = "<b>$request_by</b> has accepted your friend request";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
            //event(new StatusLiked($post->posted_by));
            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/
    }

    public function cancelrequest() ////by user send/cancel button
    {
        $friend = Friend::where(['user_id' => request('user_id'), 'friend_id' => request('friend_id'), 'status' => 'pending'])->first();
        if ($friend != null) {
            $friend->delete();
            $ret['status'] = 'Request Cancelled';
            echo json_encode($ret);
        } else {
            $ret['status'] = 'No record available';
            echo json_encode($ret);
        }
    }

    public function unfriend()
    {
        $user_id = request('user_id');
        $friend_id = request('friend_id');
        $friend = DB::select("select f.id, f.status as status from friends f where (f.user_id = $user_id and f.friend_id = $friend_id or f.user_id = $friend_id and f.friend_id = $user_id)");
        if ($friend != null) {
            $f = Friend::find($friend[0]->id);
            $f->delete();
            $ret['status'] = 'unfriend';
            echo json_encode($ret);
        } else {
            $ret['status'] = 'No record available';
            echo json_encode($ret);
        }
    }

    public function checkrequest()
    {
        $user_id = request('user_id');
        $friend_id = request('friend_id');
        $friend = DB::select("select f.status as status from friends f where (f.user_id = $user_id and f.friend_id = $friend_id or f.user_id = $friend_id and f.friend_id = $user_id)");
//        echo json_encode($friend);
//        $friend = Friend::find(request('requestid'));
        if ($friend != null) {

            if ($friend[0]->status == 'pending') {
                $queryResult = DB::select("call GetFriendType($user_id,$friend_id)");
                $result = collect($queryResult);
                echo json_encode($result[0]);
            } else {
                $ret['status_'] = $friend[0]->status;
                echo json_encode($ret);
            }
        } else {
            $ret['status_'] = 'No record available';
            echo json_encode($ret);
        }
    }

    public function checkrequeststatus()
    {
        $user_id = request('user_id');
        $friend_id = request('friend_id');
        $queryResult = DB::select("call GetFriendType($user_id,$friend_id)");
        $result = collect($queryResult);
        echo json_encode($result[0]);
    }

    public function searchuser()
    {
        $s = request('search_name');
        $user = DB::select("SELECT u.id, t.name, u.profile_pic FROM users u, timelines t WHERE u.timeline_id = t.id  and t.name LIKE '$s%' and u.active = 1");
        if ($user != null) {
            $ret['response'] = $user;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record available';
            echo json_encode($ret);
        }
    }

    public function requestlist()
    {
        $user_id = request('user_id');
        $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic from users u where u.id in (select f.user_id from friends f where f.status='pending' and f.friend_id=$user_id)");
        if ($friendlist != null) {
            $ret['response'] = $friendlist;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record available';
            echo json_encode($ret);
        }
    }
    /*****************friend request/accept/cancel/get*******************/

    /*********Change Password*******/
    public function profileupload(Request $request)
    {
        $user_id = request('user_id');
        $user = UserModel::find($user_id);
        $timeline = Timeline::find($user->timeline_id);
        $timeline->name = request('fname') . " " . request('lname');
        $timeline->fname = request('fname');
        $timeline->lname = request('lname');
        $timeline->save();

        $user->birthday = Carbon::parse(request('dob'))->format('Y-m-d');
        $user->city = request('city');
        $user->country_id = request('country');
        $user->gender = request('gender');
        $user->profession = request('profession');
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
        $ret['response'] = $user->profile_pic;
        echo json_encode($ret);
    }

    public function about(Request $request)
    {
        $user_id = request('user_id');
        $userdata = DB::select("SELECT t.name, u.profile_pic, u.rc, (SELECT c.nicename from countries c where c.id = u.country_id) as country_name, u.city,u.contact, u.email, u.birthday, u.gender, u.profession, u.profession_other,u.member_type,u.contact_privacy FROM users u, timelines t WHERE u.timeline_id = t.id and u.id = $user_id");
        if (count($userdata) > 0) {
            $ret['response'] = $userdata;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function removeProfile(Request $request)
    {
        $user_id = request('user_id');
        $user = UserModel::find($user_id);
        if (isset($user)) {
            $user->profile_pic = 'images/Male_default.png';
            $user->save();
            $ret['response'] = 'Profile Pic has been removed';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function change_password()
    {
        $user_id = request('user_id');
        $password = request('password');
        $user = UserModel::find($user_id);
        if ($user != null) {
            $user->password = md5($password);
            $user->save();
            $ret['response'] = 'change successfully';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record available';
            echo json_encode($ret);
        }
    }
    /*********Change Password*******/

    /*****************ads*******************/
    public function addads(Request $request)
    {
        $asd = new Ads();
        $asd->user_id = request('user_id');
        $asd->ad_title = request('ad_title');
        $asd->ad_description = request('ad_description');
        $asd->ad_category_id = request('ad_category_id');
        $asd->other_cat = request('other_cat');
        $asd->city = request('city');
        $asd->selling_cost = request('selling_cost');
        $asd->email = request('email');
        $asd->contact = request('contact');
        $asd->location = request('location');
        $asd->save();
//        if (request('ad_img') != null) {
//            $adimg = new AdsImages();
//            $destination_path = 'buysell/';
//            $filename = str_random(6) . '_' . $file->getClientOriginalName();
//            $file->move($destination_path, $filename);
//            $adimg->image_url = $destination_path . $filename;
//            $adimg->ad_id = $asd->id;
//            $adimg->save();
//        }
        if (request('ad_img') != null) {
            $array = $request->input('ad_img');
            foreach (json_decode($array) as $obj) {
                $adimg = new AdsImages();
                $data = $obj->image;
                $data = base64_decode($data);
                $image_name = str_random(6) . '.png';
                $destinationPath = 'buysell/' . $image_name;
//                $directory = "buysell/" . $user->id;
//                if (!file_exists($directory)) {
//                    File::makeDirectory($directory);
//                }
                file_put_contents($destinationPath, $data);
                $adimg->image_url = 'buysell/' . $image_name;
                $adimg->ad_id = $asd->id;
                $adimg->save();
            }
        }
//        if (request('ad_img') != null) {
//            $data = request('ad_img');
//            $adimg = new AdsImages();
//            list($type, $data) = explode(';', $data);
//            list(, $data) = explode(',', $data);
//            $data = base64_decode($data);
//            $image_name = time() . '.png';
//            $path = "buysell/" . $image_name;
//            file_put_contents($path, $data);
//            $adimg->image_url = $path;
//            $adimg->ad_id = $asd->id;
//            $adimg->save();
//        }

        $ret['response'] = 'Ad has been submitted';
        echo json_encode($ret);
//        $result
//        return $this->sendResponse($client_address, 'Ad has been submitted');
    }

    public function editads(Request $request)
    {
        $asd = Ads::find(request('add_id'));
        if (isset($asd)) {
            $asd->user_id = request('user_id');
            $asd->ad_title = request('ad_title');
            $asd->ad_description = request('ad_description');
            $asd->ad_category_id = request('ad_category_id');
            $asd->other_cat = request('other_cat');
            $asd->city = request('city');
            $asd->selling_cost = request('selling_cost');
            $asd->email = request('email');
            $asd->contact = request('contact');
            $asd->location = request('location');
            $asd->save();
            if (request('ad_img') != null) {
                $post_media = AdsImages::where(['ad_id' => $asd->id])->get();
                foreach ($post_media as $media) {
                    $image_path = $media->image_url;
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                AdsImages::where(['ad_id' => $asd->id])->delete();
                $array = $request->input('ad_img');
                foreach (json_decode($array) as $obj) {
                    $adimg = new AdsImages();
                    $data = $obj->image;
                    $data = base64_decode($data);
                    $image_name = str_random(6) . '.png';
                    $destinationPath = 'buysell/' . $image_name;
//                $directory = "buysell/" . $user->id;
//                if (!file_exists($directory)) {
//                    File::makeDirectory($directory);
//                }
                    file_put_contents($destinationPath, $data);
                    $adimg->image_url = 'buysell/' . $image_name;
                    $adimg->ad_id = $asd->id;
                    $adimg->save();
                }
            }
            return $this->sendResponse([], 'Ad has been updated');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    public function deleteads(Request $request)
    {
        $asd = Ads::find(request('add_id'));
        $asd->is_active = 0;
        $asd->save();
        if (isset($asd)) {
//            $post_media = AdsImages::where(['ad_id' => $asd->id])->get();
//            foreach ($post_media as $media) {
//                $image_path = $media->image_url;
//                if (File::exists($image_path)) {
//                    File::delete($image_path);
//                }
//            }
//            AdsImages::where(['ad_id' => $asd->id])->delete();
//            $asd->delete();
            return $this->sendResponse([], 'Ad has been Deleted');
        } else {
            return $this->sendError('No record available', '');
        }
    }

    public function user_ads()
    {
        $results = array();
//        $ads_img = array();
        $ads = Ads::where(['user_id' => request('user_id'), 'is_active' => 1])->orderBy('id', 'desc')->get();
//        foreach ($ads as $ad)
//        $ads_img = AdsImages::where(['ad_id' => $ad->id])->get();
        foreach ($ads as $item) {
            $ads_img = AdsImages::where(['ad_id' => $item->id])->get();
            $results[] = ['id' => $item->id, 'ad_title' => $item->ad_title, 'ad_description' => $item->ad_description, 'ad_category_id' => $item->ad_category_id, 'other_cat' => $item->other_cat, 'user_id' => $item->user_id, 'city' => $item->city, 'status' => $item->status, 'is_approved' => $item->is_approved, 'is_active' => $item->is_active, 'created_time' => $item->created_time, 'contact' => $item->contact, 'email' => $item->email, 'selling_cost' => $item->selling_cost, 'location' => $item->location, 'ad_img' => $ads_img];
        }
        if (count($results) > 0) {
//            $ret['response'] = $results;
//            echo json_encode($ret);
            return $this->sendResponse($results, 'User Ads');
        } else {
            return $this->sendError('No record available', '');
//            $ret['response'] = 0;
//            echo json_encode($ret);
        }
    }

    public function all_ads()
    {
        $results = array();
//        $ads_img = array();
        $ads = Ads::where(['is_active' => 1, 'is_approved' => 1])->orderBy('id', 'desc')->get();
        foreach ($ads as $item) {
            $ads_img = AdsImages::where(['ad_id' => $item->id])->get();
//            $ad = isset($ads_img) ? $ads_img : '';
            $results[] = ['id' => $item->id, 'ad_title' => $item->ad_title, 'ad_description' => $item->ad_description, 'ad_category_id' => $item->ad_category_id, 'other_cat' => $item->other_cat, 'user_id' => $item->user_id, 'city' => $item->city, 'status' => $item->status, 'is_approved' => $item->is_approved, 'is_active' => $item->is_active, 'created_time' => $item->created_time, 'contact' => $item->contact, 'email' => $item->email, 'selling_cost' => $item->selling_cost, 'location' => $item->location, 'ad_img' => $ads_img];
        }
        if (count($results) > 0) {
//            $ret['response'] = $results;
//            echo json_encode($ret);
            return $this->sendResponse($results, 'All Ads');
        } else {
            return $this->sendError('No record available', '');
//            $ret['response'] = 0;
//            echo json_encode($ret);
        }
    }

    public function get_category()
    {
        $adcats = AdCategory::where(['is_active' => 1])->get();
        if ($adcats->count() > 0) {
            $arr = [];
            foreach ($adcats as $data) {
                $arr[] = $data;
            }
            $ret['response'] = $arr;
            echo json_encode($ret);
        } else {
            $ret['response'] = 0;
            echo json_encode($ret);
        }
    }

    public function adsbycategory(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'ad_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $ad_category_id = request('ad_category_id');
        $results = array();
        $ads_img = array();
        $ads = Ads::where(['is_active' => 1, 'ad_category_id' => $ad_category_id, 'is_approved' => 1])->get();
        foreach ($ads as $item) {
            $ads_img = AdsImages::where(['ad_id' => $item->id])->get();
//            $ad = isset($ads_img) ? $ads_img : '';
            $results[] = ['id' => $item->id, 'ad_title' => $item->ad_title, 'ad_description' => $item->ad_description, 'ad_category_id' => $item->ad_category_id, 'other_cat' => $item->other_cat, 'user_id' => $item->user_id, 'city' => $item->city, 'status' => $item->status, 'is_approved' => $item->is_approved, 'is_active' => $item->is_active, 'created_time' => $item->created_time, 'contact' => $item->contact, 'email' => $item->email, 'selling_cost' => $item->selling_cost, 'location' => $item->location, 'ad_img' => $ads_img];
        }
        if (count($results) > 0) {
//            $ret['response'] = $results;
//            echo json_encode($ret);
            return $this->sendResponse($results, 'Category Ads');
        } else {
            return $this->sendError('No record available', '');
//            $ret['response'] = 0;
//            echo json_encode($ret);
        }
    }

    public function myadsdelete()
    {
        $u_id = request('user_id');
        $ad_id = request('ad_id');
        $myads = DB::select("select * FROM ads WHERE user_id=$u_id and id = $ad_id");
        if (count($myads) > 0) {
            DB::table('ads')->where('id', $ad_id)->delete();
            $ret['response'] = 'advertisement has been deleted';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }
    /*****************ads*******************/

    /********comment list*******/
    public function commentlist()
    {
        $post_id = request('post_id');
        $post_comments = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description, c.description2 from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post_id");
        if (count($post_comments) > 0) {
            $ret['response'] = $post_comments;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    /********comment list*******/

    /*******Post******/
    public function addpost(Request $request)
    {
//        echo count($_FILES['post_file']['name']);
        if (request('description') != null)
            $des = json_decode(request('description'));

        $posts = new Posts();
        $user = UserModel::find(request('post_id')); //changed user_id to post_id 11-sep-2018
        $posts->user_id = $user->id;
        $posts->description = LaravelEmojiOneFacade::toShort(isset($des->post) ? $des->post : null); //isset($des->post) ? $des->post : null;

        $posts->description2 = isset($des->post) ? $des->post : null;

        $posts->timeline_id = $user->timeline_id;
        $posts->posted_by = request('user_id');
        $posts->created_at = Carbon::now('Asia/Kolkata');
        $posts->save();
//        $upload_file = count($_FILES['post_file']['name']);
//        if (request('post_file') != null) {
//            for ($i = 0; $i < $upload_file; $i++) {
//                $arr = [];
//                $i = 1;
        $destinationPath = 'userposts/' . $user->id . '/';
        $file = $request->file('post_file');
        if (request('post_file') != null) {
            $post_media = new Post_media();
            $post_media->post_id = $posts->id;
            $temp = str_random(6) . '_post_user_id_' . $user->id . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $temp);
//            $i++;
            $valid_ext_v = ["mp4", "ogg", "webm", "3gp"];
            $counter = 0;
            foreach ($valid_ext_v as $ext) {
                if ($file->getClientOriginalExtension() == $ext) {
                    $counter++;
                }
            }
            $post_media->media_type = ($counter > 0) ? 'vd' : 'img';
            $post_media->media_url = $destinationPath . $temp;
            $post_media->save();
        }
//            }
//        }
        $ret['response'] = 'Successfully posted, keep going' . $posts->id;
        echo json_encode($ret);
    }

    /*********This Function is using***********/
    public function addpost2(Request $request)
    {
//        echo count($_FILES['post_file']['name']);
        if (request('description') != null)
            $des = json_decode(request('description'));

        $posts = new Posts();
        $user = UserModel::find(request('user_id'));
        $posts->user_id = $user->id;
        $posts->description = LaravelEmojiOneFacade::toShort(isset($des->post) ? $des->post : null); //isset($des->post) ? $des->post : null;

        $posts->description2 = isset($des->post) ? $des->post : null;
        $posts->created_at = Carbon::now('Asia/Kolkata');
        $posts->timeline_id = $user->timeline_id;
        $posts->posted_by = request('user_id');
        $posts->checkin = request('checkin');
        $posts->post_privacy = request('post_privacy');
        $posts->save();
        if (request('post_file') != null) {
            $array = $request->input('post_file');
            foreach (json_decode($array) as $obj) {
                $post_media = new Post_media();
                $post_media->post_id = $posts->id;
                $data = $obj->image;
                $data = base64_decode($data);
                $image_name = str_random(6) . "$obj->type";
                $destinationPath = './userposts/' . $user->id . '/' . $image_name;
                $directory = "userposts/" . $user->id;
                if (!file_exists($directory)) {
                    File::makeDirectory($directory);
                }
                file_put_contents($destinationPath, $data);
                $post_media->media_url = 'userposts/' . $user->id . '/' . $image_name;
                $post_media->media_type = $obj->type != '.png' ? 'vd' : 'img';
                $post_media->save();
            }
        }
        $ret['response'] = 'Successfully posted, keep going';
        echo json_encode($ret);
    }

    public function post_text()
    {
        $des = json_decode(request('description'));
        $posts = Posts::find(request('post_id'));
        $posts->description = LaravelEmojiOneFacade::toShort($des->post); //$des->post;.
        $posts->description2 = isset($des->post) ? $des->post : null;
        $posts->save();
        $ret['response'] = 'Post text has been saved';
        echo json_encode($ret);

    }

    public function post_video(Request $request)
    {
        $posts = Posts::find(request('post_id'));
        $destinationPath = 'userposts/' . $posts->user_id . '/';
        $file = $request->file('post_file');
        if (request('post_file') != null) {
            $post_media = new Post_media();
            $post_media->post_id = $posts->id;
            $temp = str_random(6) . '_post_user_id_' . $posts->user_id . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $temp);
            $valid_ext_v = ["mp4", "ogg", "webm", "3gp"];
            $counter = 0;
            foreach ($valid_ext_v as $ext) {
                if ($file->getClientOriginalExtension() == $ext) {
                    $counter++;
                }
            }
            $post_media->media_type = 'vd';
            $post_media->media_url = $destinationPath . $temp;
            $post_media->save();
        }
        $posts->save();
        $ret['response'] = 'Video has been saved';
        echo json_encode($ret);

    }

    public function like_post()
    {
        $user = UserModel::find(request('user_id'));
        $post_like = Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->first();
        if (isset($post_like)) {
            $post_like->delete();
            $ret['response'] = "Unliked";
            echo json_encode($ret);
        } else {
            $post_follow = new Post_likes();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
            $ret['response'] = "Liked";
            echo json_encode($ret);
//            $this->save_notification('liked');
            $post = Posts::find(request('post_id'));
            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && request('user_id') != $post->posted_by) {
                $comment_by = ucwords($user->timeline->name);
                $title = "Post Liked";
                $message = "$comment_by is liked your post";
                $token = $user_post_by->token;
                $data = $post;
                $user_notification = new UserNotifications();
                $user_notification->post_id = request('post_id');
                $user_notification->user_id = $post->posted_by;
                $user_notification->notified_by = $user->id;
                $user_notification->description = "<b>$comment_by</b> is liked your post";
                $user_notification->created_at = Carbon::now('Asia/Kolkata');
                $user_notification->save();
//                event(new StatusLiked($post->posted_by));
                AdminModel::getNotification($token, $title, $message, $data);
            }
            Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
            Post_unlikes::where(['post_id' => $post->id, 'user_id' => $user->id])->delete();

//        echo request('post_id');
        }
    }

    public function unlike_post()
    {
        $user = UserModel::find(request('user_id'));
        $post = Posts::find(request('post_id'));
        $comment_by = ucwords($user->timeline->name);
        $post_like = Post_unlikes::where(['post_id' => $post->id, 'user_id' => $user->id])->first();
        if (isset($post_like)) {
            $post_like->delete();
            UserNotifications::where(['post_id' => $post->id, 'user_id' => $post->posted_by, 'notified_by' => $user->id, 'description' => "<b>$comment_by</b> is disliked your post"])->delete();
            $ret['response'] = "Undisliked";
            echo json_encode($ret);
        } else {
            $post_follow = new Post_unlikes();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
            $ret['response'] = "Disliked";
            echo json_encode($ret);
//            $this->save_notification('liked');

            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && request('user_id') != $post->posted_by) {

                $title = "Post Disliked";
                $message = "$comment_by is disliked your post";
                $token = $user_post_by->token;
                $data = $post;
                $user_notification = new UserNotifications();
                $user_notification->post_id = request('post_id');
                $user_notification->user_id = $post->posted_by;
                $user_notification->notified_by = $user->id;
                $user_notification->description = "<b>$comment_by</b> is disliked your post";
                $user_notification->created_at = Carbon::now('Asia/Kolkata');
                $user_notification->save();
//                event(new StatusLiked($post->posted_by));
                AdminModel::getNotification($token, $title, $message, $data);
            }
            Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
            Post_likes::where(['post_id' => $post->id, 'user_id' => $user->id])->delete();

//        echo request('post_id');
        }
    }

    public function spam_post()
    {
        $user = UserModel::find(request('user_id'));
        $post_spam = Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->first();
        if (isset($post_spam)) {
            $post_spam->delete();
            $ret['response'] = "Unspam";
            echo json_encode($ret);
        } else {
            $post_follow = new Post_spam();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
            $ret['response'] = "Spam";
            echo json_encode($ret);

            /******Notification*******/
            $post = Posts::find(request('post_id'));
            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && request('user_id') != $post->posted_by) {
                $spam_by = ucwords($user->timeline->name);
                $title = "Post Spam";
                $message = "$spam_by is spam your post";
                $token = $user_post_by->token;
                $data = $post;
                $user_notification = new UserNotifications();
                $user_notification->post_id = request('post_id');
                $user_notification->user_id = $post->posted_by;
                $user_notification->notified_by = $user->id;
                $user_notification->description = "<b>$spam_by</b> is spam your post";
                $user_notification->created_at = Carbon::now('Asia/Kolkata');
                $user_notification->save();
//                event(new StatusLiked($post->posted_by));
                AdminModel::getNotification($token, $title, $message, $data);
            }
            /******Notification*******/
            Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();

//        echo request('post_id');
        }
    }

    public function savecomment()
    {
        $des = json_decode($_GET['description']);
        $client_address = new Comments();
        $client_address->post_id = request('post_id');
        $client_address->user_id = request('user_id');
        $client_address->description = LaravelEmojiOneFacade::toShort($des->comment);
        $client_address->description2 = $des->comment;
        $client_address->save();
        $ret['response'] = 1;
        echo json_encode($ret);
        /******Notification*******/
        $post = Posts::find(request('post_id'));
        $user = UserModel::find($post->posted_by);
        if (isset($user->token) && request('user_id') != $post->posted_by) {
            $user_comment = UserModel::find(request('user_id'));
            $comment_by = ucwords($user_comment->timeline->name);
            $title = "Post Comment";
            $message = "$comment_by is commented on your post";
            $token = $user->token;
            $data = $post;
            $user_notification = new UserNotifications();
            $user_notification->post_id = request('post_id');
            $user_notification->user_id = $post->posted_by;
            $user_notification->notified_by = $user_comment->id;
            $user_notification->description = "<b>$comment_by</b> is commented on your post";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
//            event(new StatusLiked($post->posted_by));
            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/

        //ALTER TABLE `users` CHANGE `timezone` `token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
    }

    public function savecomment_new(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $des = json_decode($_GET['description']);
        $client_address = new Comments();
        $client_address->post_id = request('post_id');
        $client_address->user_id = request('user_id');
        $client_address->description = LaravelEmojiOneFacade::toShort($des->comment);
        $client_address->description2 = $des->comment;
        $client_address->save();
//        $ret['response'] = 1;
//        echo json_encode($ret);
        return $this->sendResponse($client_address, 'Comment has been saved');
        /******Notification*******/
        $post = Posts::find(request('post_id'));
        $user = UserModel::find($post->posted_by);
        if (isset($user->token) && request('user_id') != $post->posted_by) {
            $user_comment = UserModel::find(request('user_id'));
            $comment_by = ucwords($user_comment->timeline->name);
            $title = "Post Comment";
            $message = "$comment_by is commented on your post";
            $token = $user->token;
            $data = $post;
            $user_notification = new UserNotifications();
            $user_notification->post_id = request('post_id');
            $user_notification->user_id = $post->posted_by;
            $user_notification->notified_by = $user_comment->id;
            $user_notification->description = "<b>$comment_by</b> is commented on your post";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
//            event(new StatusLiked($post->posted_by));
            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/

        //ALTER TABLE `users` CHANGE `timezone` `token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
    }

    public function editcomment()
    {
        $comment_id = request('comment_id');
        $des = json_decode($_GET['description']);
        $comment = Comments::find($comment_id);
        $comment->description = LaravelEmojiOneFacade::toShort($des->comment);
        $comment->description2 = $des->comment;
        $comment->save();
        $ret['response'] = "Comment has been updated";
        echo json_encode($ret);
    }

    public function deletecomment()
    {
        $comment_id = request('comment_id');
        $comment = Comments::find($comment_id)->delete();
        $ret['response'] = "Comment has been deleted";
        echo json_encode($ret);
    }

    public function deactivate_account()
    {
        $user_id = request('user_id');
        $user = UserModel::find($user_id);
        $user->active = 0;
        $user->save();
//        $des = json_decode($_GET['description']);
//        $comment = Comments::find($comment_id)->delete();
        //with('message', 'Ad has been rejected...!');
        $ret['response'] = "Account has been deactivated";
        echo json_encode($ret);
    }

    public function postshare()
    {
        $post_id = request('post_id');
        $user_id = request('user_id');
        $post = Posts::find($post_id);
        $posts = new Posts();
        $user = UserModel::find($user_id);
        $posts->user_id = $user->id;
        $posts->timeline_id = $user->timeline_id;
        $posts->description = $post->description;
        $posts->description2 = $post->description2;
        $posts->posted_by = $user_id;
        $posts->post_created_by = $post->posted_by;
        $posts->created_at = Carbon::now('Asia/Kolkata');
        $posts->save();

        $e_postmedia = Post_media::where(['post_id' => $post_id])->get();
        foreach ($e_postmedia as $media) {
            $post_media = new Post_media();
            $post_media->post_id = $posts->id;
            $post_media->media_type = $media->media_type;
            $post_media->media_url = $media->media_url;
            $post_media->save();
        }
        $ret['response'] = 'post has been shared';
        echo json_encode($ret);
        /******Notification*******/
        $user_old = UserModel::find($post->posted_by);
        if (isset($user_old->token)) {
            $shared_by = ucwords($user->timeline->name);
            $title = "Post Shared";
            $message = "$shared_by is shared your post";
            $token = $user_old->token;
            $data = $post;
            $user_notification = new UserNotifications();
            $user_notification->post_id = $post->id;
            $user_notification->user_id = $post->posted_by;
            $user_notification->notified_by = $user_id;
            $user_notification->description = "<b>$shared_by</b> is shared your post";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
            //event(new StatusLiked($post->posted_by));
            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/


    }

    public function getPost()
    {
//        $user_id = request('user_id');
        $user = UserModel::find(request('user_id'));
        $user_id = $user->id;
        $posts1 = DB::select("select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");
        $numrows = count($posts1);
        $rowsperpage = 10;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = array();
        $media_re = array();
        $comment_re = array();
        $like_re = array();
        $s = "select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $posts = DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $results[] = ['id' => $post->id, 'description' => $post->description, 'description2' => $post->description2, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function getPost_new()
    {
        $user = UserModel::find(request('user_id'));
        $f_user = UserModel::find(request('friend_id'));
        $friend = DB::selectOne("select f.id, f.status as status from friends f where f.status = 'friends' and (f.user_id = $user->id and f.friend_id = $f_user->id or f.user_id = $f_user->id and f.friend_id = $user->id)");
        $user_id = $user->id;

        $public = "select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active, (select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, post_created_by from posts p where p.post_privacy = 'public' and p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC";
        $friend_public = "select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active, (select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, post_created_by from posts p where (p.post_privacy = 'public' or p.post_privacy = 'friends') and  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC";
        $posts1 = isset($friend) ? DB::select($friend_public) : DB::select($public);
        $numrows = count($posts1);
        $rowsperpage = 10;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = array();
        $s = "select p.id as id, p.description,p.description2, p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active, (select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, p.post_created_by from posts p where p.post_privacy = 'public' and  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
        $q = "select p.id as id, p.description,p.description2, p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active, (select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, p.post_created_by from posts p where (p.post_privacy = 'public' or p.post_privacy = 'friends') and  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $n_s = isset($friend) ? $s : $q;
        $posts = DB::select($n_s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                /*********Change in 5th oct 18**********/
                $is_like = Post_likes::where(['user_id' => $user_id, 'post_id' => $post->id])->first();
                $is_spam = Post_spam::where(['user_id' => $user_id, 'post_id' => $post->id])->first();
                $is_dislike = Post_unlikes::where(['user_id' => $user_id, 'post_id' => $post->id])->first();

                /*********Change in 5th oct 18**********/

                $results[] = ['id' => $post->id, 'description' => $post->description, 'description2' => $post->description2, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'post_created_by_name' => $post->post_created_by_name, 'post_created_by' => $post->post_created_by, 'checkin' => $post->checkin, 'media' => $media_re, 'comment' => count($comment_re), 'like' => count($like_re), 'spam' => count($spam_re), 'dislike' => count($dislike), 'is_like' => isset($is_like) ? '1' : '0', 'is_spam' => isset($is_spam) ? '1' : '0', 'is_dislike' => isset($is_dislike) ? '1' : '0'];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function getDashboardPost()
    {
        $user_id = request('user_id');
        $posts = DB::select("select p.id as id, p.description, p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC");
        $numrows = count($posts);
//        echo  $numrows;
        // number of rows to show per page
        $rowsperpage = 10;

        // find out total pages
        $totalpages = ceil($numrows / $rowsperpage);

        // get the current page or set a default
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            $currentpage = (int)$_GET['currentpage'];
        } else {
            $currentpage = 1;  // default page number
        }


        if ($currentpage < 1) {
// set current page to first page
            $currentpage = 1;
        }

// the offset of the list, based on current page
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = array();
        $media_re = array();
        $comment_re = array();
        $like_re = array();
        $s = "select p.id as id, p.description, p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $posts = DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $results[] = ['id' => $post->id, 'description' => $post->description, 'description2' => $post->description2, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function getDashboardPost_new()
    {
        $user_id = request('user_id');
        $posts = DB::select("select p.id as id, p.description, p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active, (select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, post_created_by from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC");
        $numrows = count($posts);
//        echo  $numrows;
        // number of rows to show per page
        $rowsperpage = 5;

        // find out total pages
        $totalpages = ceil($numrows / $rowsperpage);

        // get the current page or set a default
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            $currentpage = (int)$_GET['currentpage'];
        } else {
            $currentpage = 1;  // default page number
        }


        if ($currentpage < 1) {
// set current page to first page
            $currentpage = 1;
        }

// the offset of the list, based on current page
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = array();
        $s = "select p.id as id, p.description, p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active,(select t.name from timelines t, users u where u.id = p.post_created_by and t.id=u.timeline_id) as post_created_by_name, post_created_by,p.checkin from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $posts = DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                /*********Change in 5th oct 18**********/
                $is_like = Post_likes::where(['user_id' => $user_id, 'post_id' => $post->id])->first();
                $is_spam = Post_spam::where(['user_id' => $user_id, 'post_id' => $post->id])->first();
                $is_dislike = Post_unlikes::where(['user_id' => $user_id, 'post_id' => $post->id])->first();
                /*********Change in 5th oct 18**********/

                $results[] = ['id' => $post->id, 'description' => $post->description, 'description2' => $post->description2, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'post_created_by_name' => $post->post_created_by_name, 'post_created_by' => $post->post_created_by, 'checkin' => $post->checkin, 'media' => $media_re, 'comment' => count($comment_re), 'like' => count($like_re), 'spam' => count($spam), 'dislike' => count($dislike), 'is_like' => isset($is_like) ? '1' : '0', 'is_spam' => isset($is_spam) ? '1' : '0', 'is_dislike' => isset($is_dislike) ? '1' : '0'];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function getPostbyid()
    {
        $post_id = request('post_id');
        $post = Posts::find($post_id);
        if (isset($post)) {
            $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

            $comment_re = DB::select("select c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

            $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

            $spam = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

            $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");
            /*********Change in 5th oct 18**********/
            $is_like = Post_likes::where(['post_id' => $post->id])->first();
            $is_spam = Post_spam::where(['post_id' => $post->id])->first();
            $is_dislike = Post_unlikes::where(['post_id' => $post->id])->first();
            /*********Change in 5th oct 18**********/

            $results[] = ['id' => $post->id, 'description' => $post->description, 'description2' => $post->description2, 'name' => $post->timeline->name, 'profile_pic' => $post->user->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'post_created_by_name' => $post->post_created_by_name, 'post_created_by' => $post->post_created_by, 'checkin' => $post->checkin, 'media' => $media_re, 'comment' => count($comment_re), 'like' => count($like_re), 'spam' => count($spam), 'dislike' => count($dislike), 'is_like' => isset($is_like) ? '1' : '0', 'is_spam' => isset($is_spam) ? '1' : '0', 'is_dislike' => isset($is_dislike) ? '1' : '0'];
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function post_delete()
    {
        $post_id = request('post_id');
        $post = Posts::find($post_id);
        $post_media = Post_media::where(['post_id' => $post_id])->get();
        if (count($post_media) > 0) {
            foreach ($post_media as $media) {
                $image_path = $media->media_url;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            Post_media::where(['post_id' => $post_id])->delete();
        }
        if (isset($post)) {
            $post_like = Post_likes::where(['post_id' => $post_id])->delete();
            $post->delete();
            $ret['response'] = 'post has been deleted';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function postlikelist()
    {
        $post_id = request('post_id');
        $puser = DB::select("select u.id as id, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic from users u, post_likes pl where u.id = pl.user_id and pl.post_id = $post_id");
        if (count($puser) > 0) {
            $ret['response'] = $puser;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }
    /*******Post******/

    /*******Notification******/
    public function notice()
    {
        $notification = Notification::where(['is_active' => 1])->first();
        if (isset($notification)) {
            $ret['response'] = $notification;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }
    /*******Notification******/

    /*******panic******/
    public function addpanic()
    {
        $panic_e = PanicContact::where(['user_id' => request('user_id')])->get();
        if (count($panic_e) > 0) {
            $panic_en = PanicContact::where(['user_id' => request('user_id')])->delete();
        }
        $panic = new PanicContact();
        $panic->user_id = request('user_id');
        $panic->c1 = request('c1');
        $panic->c1_name = request('c1_name');
        $panic->c2 = request('c2');
        $panic->c2_name = request('c2_name');
        $panic->c3 = request('c3');
        $panic->c3_name = request('c3_name');
        $panic->c4 = request('c4');
        $panic->c4_name = request('c4_name');
        $panic->c5 = request('c5');
        $panic->c5_name = request('c5_name');
        $panic->message = request('message');
        $panic->save();
        $ret['response'] = 'contact has been saved';
        echo json_encode($ret);
    }

    public function editpanic()
    {
        $panic = PanicContact::find(request('panic_id'));
        if (isset($panic)) {
            $panic->user_id = request('user_id');
            $panic->c1 = request('c1');
            $panic->c2 = request('c2');
            $panic->c3 = request('c3');
            $panic->c4 = request('c4');
            $panic->c5 = request('c5');
            $panic->save();
            $ret['response'] = 'contact has been updated';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function showpanic()
    {
        $panics = PanicContact::where(['user_id' => request('user_id')])->get();
        if (count($panics) > 0) {
            $ret['response'] = $panics;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    public function sendpanic()
    {
        $location = request('location');
        $panics = PanicContact::where(['user_id' => request('user_id')])->first();
        if (isset($panics)) {
            if ($panics->c1 != null)
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=MSGIND&route=4&mobiles=$panics->c1&authkey=213418AONRGdnQ5ae96f62&country=91&message=Hey%20i%20am%20in%20danger%20need%20help%20$panics->message%20Location%20$location");
            if ($panics->c2 != null)
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=MSGIND&route=4&mobiles=$panics->c2&authkey=213418AONRGdnQ5ae96f62&country=91&message=Hey%20i%20am%20in%20danger%20need%20help$panics->message%20Location%20$location");
            if ($panics->c3 != null)
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=MSGIND&route=4&mobiles=$panics->c3&authkey=213418AONRGdnQ5ae96f62&country=91&message=Hey%20i%20am%20in%20danger%20need%20help$panics->message%20Location%20$location");
            if ($panics->c4 != null)
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=MSGIND&route=4&mobiles=$panics->c4&authkey=213418AONRGdnQ5ae96f62&country=91&message=Hey%20i%20am%20in%20danger%20need%20help$panics->message%20Location%20$location");
            if ($panics->c5 != null)
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=MSGIND&route=4&mobiles=$panics->c5&authkey=213418AONRGdnQ5ae96f62&country=91&message=Hey%20i%20am%20in%20danger%20need%20help    $panics->message%20Location%20$location");
            $ret['response'] = 'Message has been send';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record found';
            echo json_encode($ret);
        }
    }

    /*******panic******/
    public function testupload(Request $request)
    {
        $user_id = request('user_id');
        $timeline = Timeline::find($user_id);
        $user = UserModel::where(['timeline_id' => $timeline->id])->first();
        $user->timeline_id = $timeline->id;
        $user->city = request('city');
        $file = $request->file('profile_pic');
        if ($request->file('profile_pic') != null) {
            $destination_path = 'profile/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $user->profile_pic = $destination_path . $filename;
        }
        $user->save();
    }

    /******Redeem*******/
    public function addBankDetailsToRedeem()
    {
        $ahName = request('ac_holder');
        $ah_no = request('ac_no');
        $ah_bnk = request('bank');
        $ah_ifs = request('ifsc');
        $ah_amt = request('amt');
        $ah_adhr = request('aadhar');
        $is_future = request('is_future');
        $user_id = request('user_id');
        $ubd = new user_bank_detail();
        $uad = $ubd::select('id')->where('user_id', $user_id)->where('ac_number', $ah_no)->get()->first();
        if (empty($uad->id)) {
            $add_details = array('account_holder' => $ahName, 'ac_number' => $ah_no, 'bank' => $ah_bnk, 'ifsc_code' => $ah_ifs, 'aadhar_pan' => $ah_adhr, 'is_future_use' => $is_future, 'user_id' => $user_id);
            DB::table('user_bank_details')->insert($add_details);
        }
        // add amount
        $add_amount = array('ac_number' => $ah_no, 'amount' => $ah_amt, 'user_id' => $user_id);
        DB::table('redeem_masters')->insert($add_amount);
        ////////////
        $ret['response'] = 'Details added Successfully';
        echo json_encode($ret);
//        return response()->json(array('s'=>'1', 't'=>'Details added Successfully'));
    }

    public function redeem_hstr(Request $request)
    {
        $user_id = request('user_id');
        $redeems = DB::select("SELECT rm.id, rm.ac_number, rm.amount, rm.status, ub.account_holder, ub.bank, ub.aadhar_pan,ub.ifsc_code, rm.created_time FROM redeem_masters rm, user_bank_details ub WHERE rm.ac_number = ub.ac_number and rm.user_id = $user_id");
        if (count($redeems) > 0) {
            $ret['response'] = $redeems;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No Record Found';
            echo json_encode($ret);
        }
    }

    /******Redeem*******/
    public function forgetp()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserModel::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user->password = md5($otp);
            $user->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");
            $ret['response'] = 'Password has been send to register number';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'Incorrect Contact';
            echo json_encode($ret);
        }
    }


    public function user_list() // All User List
    {
        $user = UserModel::find(request('user_id'));
        $user_id = $user->id;
        $user_list = DB::select("select u.id, (SELECT t.name FROM timelines t where u.timeline_id = t.id) as name, u.profile_pic from users u where u.active = 1 and u.id NOT IN (select friend_id from friends where user_id=$user_id and (status='friends' or status = 'pending')) and u.id NOT IN (select user_id from friends where friend_id=$user_id and (status='friends' or status = 'pending')) and u.id != $user_id");
        $numrows = count($user_list);
        $rowsperpage = 10;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $s = "select u.id, (SELECT t.name FROM timelines t where u.timeline_id = t.id) as name, u.profile_pic from users u where u.active = 1 and u.id NOT IN (select friend_id from friends where user_id=$user_id and (status='friends' or status = 'pending')) and u.id NOT IN (select user_id from friends where friend_id=$user_id and (status='friends' or status = 'pending')) and u.id != $user_id ORDER BY u.id DESC LIMIT $offset,$rowsperpage";
        $users_list = DB::select($s);

        if (count($users_list) > 0) {
            $ret['response'] = $users_list;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    /************Payment Success***************/
    public function success_payment()
    {
        $timeline = new Timeline();
        $user = new UserModel();
        $country = Country::getCountry();
        $rltn = new relation();

        // Get User ID from session
        $user_id = request('user_id');
        // If transaction successful
        $status = request('payment_status');
        $_SESSION['rcode'] = request('ref_code') != null ? request('ref_code') : '0';
        if ($status == 'success') {
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
        }
        $this->resetRcode(); // Reset referal code
        //////////////////
        $ret['response'] = 'Details has been added';
        echo json_encode($ret);
//        $total = $this->getTotalEarning();
//        $lbl = $this->getMembersCount();
//        return $this->redirectBack($total, $lbl); // takes user back

    }

    public function resetRcode()
    {
        $_SESSION['rcode'] = '0';
    }

    public function setUserReferralCode($user_id)
    {
        $rltn = new relation();
        if ($_SESSION['rcode'] == "0") {
            //Check rc already exists & update likewise
            $rc_from_tbl = $rltn::select('parent_id')->where('child_id', $user_id)->get()->first();
            if (isset($rc_from_tbl))
                $_SESSION['rcode'] = $rc_from_tbl->parent_id;
            else
                $_SESSION['rcode'] = "0";
        }
    }

    public function checkRelationExists($user_id)
    {
        $rltn = new relation();
        $PrntRfrID = $rltn::select('id')->where('child_id', $user_id)->get()->first();
        if (isset($PrntRfrID->id))
            return true;
        return false;
    }

    public function makeRelation($user_id)
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

    public function createRelation($rfrcd, $user_id)
    {
        $user = new UserModel();
        // parent_id is referal_id here, Usinf Id as referal_id
        $add_rltns = array('parent_id' => $rfrcd, 'child_id' => $user_id, 'PaymentStatus' => 1);
        DB::table('relations')->insert($add_rltns);
    }

    public function generateReferralCode($user_id)
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
    public function addComission($user_id)
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
//            $cmsn = $amnt;

            $add_usr_cmsn = array('SourceID' => $user_id, 'ParentID' => $userID, 'Com' => $cmsn);
            DB::table('coms')->insert($add_usr_cmsn);
            $amnt = $cmsn; // assign comission to amount
            if (!isset($getRfrID->parent_id))
                break;
            $referralCode = $getRfrID->parent_id;
        }

    }
    /*****Add Commission******/

    /************Payment Success***************/


    /**Chat*******************/
    public function checkincomingCall()
    {
        session_start();
        $userid = $_SESSION['user_master']->id;
        $one = DB::select("SELECT * FROM `user_comm` where com_first =$userid and com_call=1");
        $two = DB::select("SELECT * FROM `user_comm` where com_sec =$userid and com_call=1");

        $uone = UserComm::where(['com_first' => $userid, 'com_call' => 1])->first();
        $utwo = UserComm::where(['com_sec' => $userid, 'com_call' => 1])->first();

        if (!isset($uone)) {
            echo $com_id = $uone->com_id;
            DB::select("update user_comm set com_call=0 ,com_call_window_opend=1 where com_id=$com_id and com_call_inis!=$userid");

        } elseif (!isset($utwo)) {
            echo $com_id = $utwo->com_id;
            DB::select("update user_comm set com_call=0 ,com_call_window_opend=1 where com_id=$com_id and com_call_inis!=$userid");
        }
    }

    public function updatecall()
    {
        session_start();
        $userid = $_SESSION['user_master']->id;
        $comid = request('idsssss');
        $one = DB::select("update user_comm set com_call=1 ,com_call_inis=$userid where com_id=$comid");
    }

    public function checkdata()
    {
        session_start();
        $userid = $_SESSION['user_master']->id;
        $friendid = request('idsssss');

//        $one = DB::select("SELECT * FROM `user_comm` where com_first =$userid and com_sec=$friendid");
        $one = UserComm::where(['com_first' => $userid, 'com_sec' => $friendid])->first();
//        $two = DB::select("SELECT * FROM `user_comm` where com_first =$friendid and com_sec=$userid");
        $two = UserComm::where(['com_first' => $friendid, 'com_sec' => $userid])->first();

        if (!isset($one) and !isset($two)) {
            $user_comm = new UserComm();
            $user_comm->com_first = $userid;
            $user_comm->com_sec = $friendid;
            $user_comm->save();
//            DB::select("insert into user_comm (com_first,com_sec) values($userid,$friendid)");
            echo $user_comm->com_id;
        }

        if ($one != null and $two == null) {
            echo $one->com_id;
        }

        if ($one == null and $two != null) {
            echo $two->com_id;
        }
    }

    public function getallusers()
    {
        session_start();
        $id = $_SESSION['user_master']->id;
        $srch_name = request('srch_name');
        $condition = ($srch_name == '') ? '' : " and u.name LIKE '%$srch_name%'";
        $users = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$id and status = 'friends')");

        foreach ($users as $user) {
            { ?>
                <div class="user" onclick="testjsss(<?php echo $user->fid; ?>)"
                     id="<?php echo $user->fid; ?>"> <?php echo "<b>" . $user->name . "</b>"; ?>

                </div>
            <?php }
        }
    }

    public function saverc()
    {
        $rc = request('rc');
        $user_id = request('user_id');
        DB::table('rc_save')->where('user_id', '=', $user_id)->delete();
        $rc_save = new RcSave();
        $rc_save->rc = $rc;
        $rc_save->user_id = $user_id;
        $rc_save->save();
        $ret['response'] = 'Rc has been added';
        echo json_encode($ret);
    }

    public function getrcdetails()
    {
        $rc = request('rc');
        $user = DB::select("select u.profile_pic, (SELECT t.name from timelines t WHERE u.timeline_id = t.id) as name, u.contact, u.city FROM users u where u.rc = '$rc'");
        if (count($user) > 0) {
            $ret['response'] = $user[0];
            echo json_encode($ret);
        } else {
            $ret['response'] = 'Invalid Referral Code';
            echo json_encode($ret);
        }
    }

    public function getFriendPost()
    {
//        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find(request('search_user_id'));
        $user_id = $user->id;
        $posts1 = DB::select("select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");
        $numrows = count($posts1);
        $rowsperpage = 10;
        $totalpages = ceil($numrows / $rowsperpage);
        $limit = request('limit');
        if (request('currentpage') != '' && is_numeric(request('currentpage'))) {
            $currentpage = (int)request('currentpage');
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = array();
        $media_re = array();
        $comment_re = array();
        $like_re = array();
        $s = "select p.id as id, p.description,p.description2, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name, p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $posts = DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $results[] = ['id' => $post->id, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            echo json_encode("No Record Available");
        }
    }

    public function getmember()
    {
        $slug = request('profession');
        $user_id = request('user_id');
        if ($slug != 'Others')
            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id != $user_id and u.profession LIKE '%$slug%'");
        else
            $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id != $user_id and u.profession LIKE '%Other%'");
        if (count($friendlist) > 0) {
            $ret['response'] = $friendlist;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No Record Available';
            echo json_encode($ret);
        }
    }

    public function getuserearning()
    {
        $user_id = request('user_id');
        $com = new com();
        $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $user_id)->get();
        // Sum up all earnings
        $total = 0;
        if (count($getTotalEarningsByPID) > 0) {

            foreach ($getTotalEarningsByPID as $Ttl) {
                $total = $total + $Ttl->Com;
            }
            $ret['response'] = $total;
            echo json_encode($ret);
        } else {
            $ret['response'] = $total;
            echo json_encode($ret);
        }
    }

    public function change_privacy()
    {
        $user_id = request('user_id');
        $user = UserModel::find($user_id);
        if (isset($user)) {
            $user->contact_privacy = request('contact_privacy');
            $user->save();
            $ret['response'] = 'Privacy setting has been updated';
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No record available';
            echo json_encode($ret);
        }
    }


////////////*Ecommerse
///
//item list
//
    public function get_items(Request $request)
    {
        $items = ItemMaster::where(['is_active' => 1])->get();
        if (count($items) > 0) {
            $ret['response'] = $items;
            echo json_encode($ret);
        } else {
            $ret['response'] = 'No Item available';
            echo json_encode($ret);
        }
    }

    public function confirm_checkout(Request $request)
    {
        $total = request('total');
        $user_id = request('user_id');
        $address_id = request('address_id');
        $address = UserAddress::find($address_id);

//        $delivery_charge = DB::selectOne("select delivery_charge from delivery_charges where amount>$total and is_active= '1' and pin = '$address->zip'");

        $order = new OrderMaster();
        $order->order_no = rand(100000, 999999);
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->total = $total;
        $order->status = 'Ordered';
        $order->save();
        $cart = json_decode(request('cart'));
        foreach ($cart as $row) {
            $order_des = new OrderDescription();
            $order_des->order_master_id = $order->id;
            $order_des->item_master_id = $row->item_id;
            $order_des->qty = $row->qty;
            $order_des->unit_price = $row->unit_price;
            $order_des->total = $row->total;
            $order_des->save();
        }
        $ret['response'] = 'Order has been successful...';
        echo json_encode($ret);
    }

//    public function getOrders()
//    {
//        $user_id = request('user_id');
//        $s = "SELECT o.* FROM order_master o WHERE o.user_id = $user_id ORDER BY o.id DESC";
//        $items = DB::select($s);
//        $results = array();
//        if (count($items) > 0) {
//            foreach ($items as $item) {
//                $orders_des = DB::select("select od.* from order_description od where od.order_master_id = $item->id");
//                $results[] = ['id' => $item->id, 'order_no' => $item->order_no, 'status' => $item->status, 'orders_des' => $orders_des];
//            }
//            $ret['response'] = $results;
//            echo json_encode($ret);
//        } else {
//            $ret['response'] = 'No record available';
//            echo json_encode($ret);
//        }
//    }

    public function getOrders()
    {
        $user_id = request('user_id');
        $orders = DB::select("SELECT o.*,od.id as ods_id, od.*, (select i.name from item_master i where od.item_master_id = i.id) as item_name, (select im.image from item_master im where od.item_master_id = im.id) as item_image  FROM order_description od, order_master o WHERE o.user_id = $user_id and od.order_master_id = o.id");
        if (count($orders) > 0) {
            $ret['response'] = $orders;
            echo json_encode($ret);
//            return $this->sendResponse($orders, 'User Orders list amount');
        } else {
            $ret['response'] = 'No record available';
            echo json_encode($ret);
//            return $this->sendError('No record available', '');
        }
    }

    /**************Address API**********************/
    public function getState()
    {
        $states = DB::select("select CID, State from cities where city is null order by State asc");
        if (count($states) > 0) {
            $ret['response'] = $states;
            echo json_encode($ret);
        } else {
            $ret['response'] = 0;
            echo json_encode($ret);
        }

    }

    public function getCity()
    {
        $state_name = request('state');
        $cities = DB::select("select * from cities where City IS NOT NULL and State = '$state_name' order by City ASC");
        if (count($cities) > 0) {
            $ret['response'] = $cities;
            echo json_encode($ret);
        } else {
            $ret['response'] = 0;
            echo json_encode($ret);
        }

    }

    public function insert_user_address()
    {
        $client_address = new UserAddress();
        $client_address->user_id = request('user_id');
        $client_address->name = request('name');
        $client_address->contact = request('contact');
        $client_address->email = request('email');
        $client_address->address = request('address');
        $client_address->address2 = request('address2');
        $client_address->zip = request('pincode');
        $client_address->city_id = request('city_id');
        $client_address->state_id = request('state_id');
        $client_address->save();
        $ret['response'] = "Address has been added";
        print json_encode($ret);
    }

    public function update_user_address()
    {
        $client_address = UserAddress::find(request('address_id'));
//        $client_address->user_id = request('user_id');
        $client_address->name = request('name');
        $client_address->contact = request('contact');
        $client_address->email = request('email');
        $client_address->address = request('address');
        $client_address->address2 = request('address2');
        $client_address->zip = request('pincode');
        $client_address->city_id = request('city_id');
        $client_address->state_id = request('state_id');
        $client_address->save();
        $ret['response'] = "Address has been updated";
        print json_encode($ret);
    }

    public function get_address_by_uid()
    {
        $user_id = request('user_id');
        $all_regs = DB::select("select u.*, (select c.state from cities c where u.state_id = c.CID) as state, (select c.state from cities c where u.city_id = c.CID) as city from user_address u where user_id = '$user_id'");
        if (count($all_regs) > 0) {
            $ret['response'] = $all_regs;
            echo json_encode($ret);
        } else {
            $ret['response'] = 0;
            echo json_encode($ret);
        }
    }

    /**************Address API**********************/

    public function user_registration()
    {
        $checkuser = UserModel::where(['email' => request('email')])->first();
        $checkcontact = UserModel::where(['contact' => request('contact')])->first();
        if (isset($checkuser)) {
            $ret['response'] = "Email already exist";
            echo json_encode($ret);
        } elseif (isset($checkcontact)) {
            $ret['response'] = "Contact already exist";
            echo json_encode($ret);
        } else {
            $timeline = new Timeline();
            $timeline->name = request('fname') . " " . request('lname');
            $timeline->fname = request('fname');
            $timeline->lname = request('lname');
            $timeline->save();
            $contact = request('contact');
            $otp = rand(100000, 999999);
            $rc = rand(10000000, 99999999);
            $user = new UserModel();
            $user->timeline_id = $timeline->id;
            $user->email = request('email');
            $user->contact = $contact;
            $user->birthday = Carbon::parse(request('dob'))->format('Y-m-d');
            $user->password = md5(request('password'));
            $user->token = request('token');
            $user->country_id = 91;
            $user->city = request('city');
            $user->state = request('state');
            $user->gender = request('gender');
            $user->otp = $otp;
            $user->rc = "rc" . $rc;
            $user->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$contact&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");

            /*-------------MLM  Started---------------*/
            $this->CreateRegRelation(request('rc'));
            /*-------------MLM  Ends---------------*/


            /***********Mail************/
//            $allmails = ['retinodes.bijendra@gmail.com'];
//
//            foreach ($allmails as $mail) {
//                $email[] = $mail;
//            }
//            if (count($email) > 0) {
//                $mail = new \App\Mail();
//                $mail->to = implode(",", $email);
//                $mail->subject = 'Connecting-one';
//                $siteurl = 'https://www.connecting-one.com/';
//                $username = request('fname') . " " . request('lname');
//                $salutation = request('gender') == 'male' ? "Mr." : "Ms.";
//
//                $message = '<table width="650" cellpadding="0" cellspacing="0" align="center" style="background-color:#ececec;padding:40px;font-family:sans-serif;overflow:scroll"><tbody><tr><td><table cellpadding="0" cellspacing="0" align="center" width="100%"><tbody><tr><td><div style="line-height:50px;text-align:center;background-color:#fff;border-radius:5px;padding:20px"><a href="' . $siteurl . '" target="_blank" ><img src="' . $siteurl . 'images/logo.png"></a></div></td></tr><tr><td><div><img src="' . $siteurl . 'images/acknowledgement.jpg" style="height:auto;width:100%;" tabindex="0"><div dir="ltr" style="opacity: 0.01; left: 775px; top: 343px;"><div><div class="aSK J-J5-Ji aYr"></div></div></div></div></td></tr><tr><td style="background-color:#fff;padding:20px;border-radius:0px 0px 5px 5px;font-size:14px"><div style="width:100%"><h1 style="color:#007cc2;text-align:center">Thank you ' . $salutation . ' ' . $username . '</h1><p style="font-size:14px;text-align:center;color:#333;padding:10px 20px 10px 20px">Thank you for your registration in www.connecting-one.com is a unique Earning & advertising platform that brings together the socially conscious members & Advertisers.<br   /> Your otp is ' . 123 . '</p></div></td></tr></tbody></table></td></tr><tr><td style="padding:20px;font-size:12px;color:#797979;text-align:center;line-height:20px;border-radius:5px 5px 0px 0px">DISCLAIMER - The information contained in this electronic message (including any accompanying documents) is solely intended for the information of the addressee(s) not be reproduced or redistributed or passed on directly or indirectly in any form to any other person.</td></tr></tbody></table>';
//
//                $mail->body = $message;
//                if ($mail->send_mail()) {
//                    //return redirect('mail')->withErrors('Email sent...');
//                } else {
//                    //return redirect('mail')->withInput()->withErrors('Something went wrong. Please contact admin');
//                }
//            }

            $ret['response'] = "Registration has been successful";
            echo json_encode($ret);
        }
    }

    public function CreateRegRelation($rfrcd)
    {
        $user = new UserModel();
        if (empty($rfrcd))
            $rfrcd = 0;
        // Get ID from registered Email ID
        $regID = $user::select('id')->where('email', request('email'))->get()->first();
        $user_Reg_ID = $regID->id;
        // parent_id is referal_id here, Usinf Id as referal_id
        $add_rltns = array('parent_id' => $rfrcd, 'child_id' => $user_Reg_ID);
        DB::table('relations')->insert($add_rltns);
    }

    public function getusernotification()
    {
        $user_id = request('user_id');
//        $user_notifications = DB::select("select t.name, (select c.state from cities c where u.state_id = c.CID) as state, (select c.state from cities c where u.city_id = c.CID) as city from users u, timeline t, notifications n where  u.timeline_id = t.id and n.notified_by = u.id and n.user_id = '$user_id'");
        $user_notifications = UserNotifications::where(['user_id' => $user_id])->orderBy('id', 'desc')->get();
        $results = [];
        if (count($user_notifications) > 0) {
            foreach ($user_notifications as $user_notification) {
                $user = UserModel::find($user_notification->notified_by);
                $results[] = ['id' => $user_notification->id, 'post_id' => $user_notification->post_id, 'description' => $user_notification->description, 'user_id' => $user_notification->user_id, 'notified_by' => $user_notification->notified_by, 'seen' => $user_notification->seen, 'notified_by_name' => ucwords($user->timeline->name), 'notify_by_pic' => $user->profile_pic, 'created_at' => $user_notification->created_at];
            }
            $ret['response'] = $results;
            echo json_encode($ret);
        } else {
            $ret['response'] = "No Record Available";
            echo json_encode($ret);
        }
    }

    public function make_as_read_noti()
    {
        $noti = UserNotifications::find(request('notification_id'));
        if (isset($noti)) {
            $noti->seen = 1;
            $noti->save();
            $ret['response'] = "Notification marked as read";
            print json_encode($ret);
        } else {
            $ret['response'] = "No Record Available";
            echo json_encode($ret);
        }
    }

    public function remove_noti()
    {
//        $directory = 'user_post/1';
//        if (!file_exists($directory)) {
//            File::makeDirectory($directory);
//
//        }
        $noti = UserNotifications::find(request('notification_id'));
        if (isset($noti)) {
            $noti->delete();
            $ret['response'] = "Notification has been removed";
            print json_encode($ret);
        } else {
            $ret['response'] = "No Record Available";
            echo json_encode($ret);
        }
    }

    public function user_network(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user_id = request('user_id'); //user_id
        $user = UserModel::find($user_id);
        if (isset($user)) {
            // Id to get records
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
            $result = [];
            if (count($getChildsByParentID) > 0) {
                foreach ($getChildsByParentID as $chlds) {
                    $network_user = UserModel::find($chlds->child_id);
                    $getUserDetailsByID = $tmln::select('fname', 'lname', 'avatar_id')->where('id', $network_user->timeline_id)->get();
                    $getParentReferalID = $user::select('rc')->where('id', $chlds->child_id)->get();
                    $getMembersCount = $rltn::select('id')->where('parent_id', $getParentReferalID[0]->rc)->count();
                    $result[] = ['UserID' => $chlds->child_id, 'FirstName' => $getUserDetailsByID[0]->fname, 'LastName' => $getUserDetailsByID[0]->lname, 'ImageID' => $network_user->profile_pic, 'MemberCount' => $getMembersCount];
                    $lst_usr_id = $chlds->id;
                }
//        return response()->json(array('t' => $result));
                return $this->sendResponse($result, 'User Network List');
            } else {
                return $this->sendError('No member available in your network list', '');
            }
        } else {
            return $this->sendError('User record not available', '');
        }
    }
}



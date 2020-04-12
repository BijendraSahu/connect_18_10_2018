<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\ChatMessage;
use App\ChatModel;
use App\Login;
use App\LoginDetail;
use Carbon\Carbon;
use ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class FrontendController extends Controller
{


    public function home()
    {
        return view('chat.home');
//        $this->middleware = $middleware;
    }

    public function login_submit()
    {
        $login = Login::where(['username' => request('username')])->first();
        if (isset($login)) {
            if (password_verify(request('password'), $login->password)) {
                $_SESSION['user_id'] = $login->user_id;
                $_SESSION['username'] = $login->username;
                $loginDetails = new LoginDetail();
                $loginDetails->user_id = $login->user_id;
                $loginDetails->save();
                $_SESSION['login_details_id'] = $loginDetails->login_details_id;
                return redirect('home');
//                header('location:index.php');
            } else {
                $message = '<label>Wrong Password</label>';
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }


    public function get_all_user()
    {
        $se_user = $_SESSION['user_id'];
        $friendlist = DB::select("select u.id as fid, (select t.fname from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$se_user) or u.id in (select f.user_id from friends f where f.friend_id=$se_user)");
        $output = '';
        foreach ($friendlist as $friend) {
            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $user_last_activity = ChatModel::fetch_user_last_activity($friend->fid, '');
            $status = '';
            if ($user_last_activity > $current_timestamp) {
                $status = '</div><div class="chat_status online"></div></div></div>';
            } else {
                $status = '</div><div class="chat_status offline"></div></div></div>';
            }
            $output .= '<div style="cursor: pointer;" class="sidebar-name start_chat" data-touserid="' . $friend->fid . '" data-tousername="' . $friend->name . '">';
            $output .= '<div><img width="30" height="30" src="' . url('') . '/' . $friend->profile_pic . '"/><div class="chatbot_name">' . $friend->name . " " . ChatModel::count_unseen_message($friend->fid, $_SESSION['user_id'], '') . ' ' . ChatModel::fetch_is_type_status($friend->fid, '');
            $output .= $status;
        }
        echo $output;
    }

    public function chatshow()
    {
        $friend = AdminModel::find(1);
        if ($friend->date == 0) {
            $friend->date = 1;
            $friend->save();
            echo "Showing";
        } else {
            $friend->date = 0;
            $friend->save();
            echo "Hidden";
        }
    }

    public function get_all_user_old()
    {
        $se_user = $_SESSION['user_id'];


        $friendlist = DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$se_user) or u.id in (select f.user_id from friends f where f.friend_id=$se_user)");
        foreach ($friendlist as $friend) {
            $status = '';
            $output = '<div style="cursor: pointer;" class="sidebar-name start_chat" data-touserid="' . $friend->fid . '" data-tousername="' . $friend->name . '">';
            $output .= '<div><img width="30" height="30" src="' . url('') . '/' . $friend->profile_pic . '"/><div class="chatbot_name">' . $friend->name . ChatModel::count_unseen_message($friend->fid, $_SESSION['user_id'], '') . ' ' . ChatModel::fetch_is_type_status($friend->fid, '');
            $user_last_activity = \App\ChatModel::fetch_user_last_activity($friend->fid, '');
            if ($user_last_activity > date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . '- 10 second'))) {
                $output .= '</div><div class="chat_status online"></div></div></div>';
            } else {
                $output .= '</div><div class="chat_status online"></div></div></div>';
            }
        }


//        $query = "SELECT * FROM login WHERE user_id != '" . $_SESSION['user_id'] . "'";
        $se_user = $_SESSION['user_id'];
        $log_users = Login::where('user_id', '!=', "$se_user")->get();
//        return view('chat.get_all_users')->with(['log_users' => $log_users]);

        $output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';
        foreach ($log_users as $row) {
            $status = '';
            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $user_last_activity = \App\ChatModel::fetch_user_last_activity($row->user_id, '');
            if ($user_last_activity > $current_timestamp) {
                $status = '<span class="label label-success">Online</span>';
            } else {
                $status = '<span class="label label-danger">Offline</span>';
            }
            $output .= '
	<tr>
		<td>' . $row['username'] . ' ' . \App\ChatModel::count_unseen_message($row->user_id, $_SESSION['user_id'], '') . ' ' . \App\ChatModel::fetch_is_type_status($row->user_id, '') . '</td>
		<td>' . $status . '</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row->user_id . '" data-tousername="' . $row->username . '">Start Chat</button></td>
	</tr>
	';
        }

        $output .= '</table>';

        echo $output;

    }

    public function update_last_activity()
    {
        $loginDet = LoginDetail::find($_SESSION["login_details_id"]);
        $loginDet->last_activity = Carbon::now();
        $loginDet->save();
    }

    public function fetch_user_chat_history()
    {

        $connect = '';
        ChatModel::fetch_user_chat_history($_SESSION['user_id'], request('to_user_id'), '');
    }

    public function update_is_type_status()
    {
        $is_type = request('is_type');
        DB::select("update login_details SET is_type = '$is_type' WHERE login_details_id = '" . $_SESSION["login_details_id"] . "'");
    }

    public function group_chat()
    {
        $action = request('action');
        if ($action == 'insert_data') {
            $chat_msg = new ChatMessage();
            $chat_msg->from_user_id = $_SESSION["user_id"];
            $chat_msg->chat_message = request('chat_message');
            $chat_msg->status = 1;
            $chat_msg->save();
        }
        if ($action == 'fetch_data') {
            $connect = '';
            ChatModel::fetch_group_chat_history($connect);
        }
    }

    public function insert_chat()
    {
        $chat_msg = new ChatMessage();
        $chat_msg->to_user_id = request('to_user_id');
        $chat_msg->from_user_id = $_SESSION["user_id"];
        $chat_msg->chat_message = LaravelEmojiOneFacade::toShort(request('chat_message'));
        $chat_msg->chat_message_android = request('chat_message');
        $chat_msg->status = 1;
        $chat_msg->timestamp = Carbon::now('Asia/Kolkata');
        $chat_msg->save();
        //$connect = '';
        //ChatModel::fetch_group_chat_history($connect);
        $output = '<ul class="list-unstyled">';
        $user_name = '<b class="text-success">You</b>';
        $output .= '

		<li style="border-bottom:1px dotted #ccc">
			<p>' . $user_name . ' - ' . LaravelEmojiOneFacade::shortnameToImage($chat_msg->chat_message) . ' <div align="right">
					- <small><em>' . Carbon::parse($chat_msg->timestamp)->format('d-M-Y h:i A') . '</em></small>
				</div>
			</p>
		</li>
		';
        $output .= '</ul>';
        echo $output;
    }
//    public function test(){
//        $lat = YOUR_CURRENT_LATTITUDE;
//        $lon = YOUR_CURRENT_LONGITUDE;
//
//        DB::table("posts")->select("posts.id",DB::raw("6371 * acos(cos(radians(" . $lat . "))
//        * cos(radians(posts.lat)) * cos(radians(posts.lon) - radians(" . $lon . ")) + sin(radians(" .$lat. ")) * sin(radians(posts.lat))) AS distance"))->groupBy("posts.id")->get();
//    }
}

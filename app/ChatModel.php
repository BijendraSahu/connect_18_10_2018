<?php

namespace App;

use Carbon\Carbon;
use ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChatModel extends Model
{
    public static function fetch_user_last_activity($user_id, $connect)
    {
//        $query = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
        $result = DB::select("SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1");
//        $statement = $connect->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll();
        foreach ($result as $row) {
            return $row->last_activity;
        }
    }

    public static function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
    {
//        $query = "
//	SELECT * FROM chat_message
//	WHERE (from_user_id = '" . $from_user_id . "'
//	AND to_user_id = '" . $to_user_id . "')
//	OR (from_user_id = '" . $to_user_id . "'
//	AND to_user_id = '" . $from_user_id . "')
//	ORDER BY timestamp DESC
//	";

        $result = DB::select("SELECT * FROM chat_message WHERE (from_user_id = '" . $from_user_id . "' AND to_user_id = '" . $to_user_id . "') OR (from_user_id = '" . $to_user_id . "' AND to_user_id = '" . $from_user_id . "') ORDER BY timestamp DESC");
//        $statement = $connect->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll();
        if (count($result) > 0) {
            $output = '<ul class="list-unstyled">';
            foreach ($result as $row) {
                $user_name = '';
                if ($row->from_user_id == $from_user_id) {
                    $user_name = '<b class="text-success">You</b>';
                } else {
                    $user_name = '<b class="text-danger">' . ChatModel::get_user_name($row->from_user_id, $connect) . '</b>';
                }
                $output .= '
		<li style="border-bottom:1px dotted #ccc">
			<p>' . $user_name . ' - ' . LaravelEmojiOneFacade::shortnameToImage($row->chat_message) . '
				<div align="right">
					- <small><em>' . Carbon::parse($row->timestamp)->format('d-M-Y h:i A') . '</em></small>
				</div>
			</p>
		</li>
		';
            }
            $output .= '</ul>';
        } else {
            $user = UserModel::find($to_user_id);
            $tm = Timeline::find($user->timeline_id);
            $output = '<ul class="list-unstyled">';
            $output .= '<li style="border-bottom:1px dotted #ccc; text-align:center;">
                            <small><em>Say hi to your new Connecting-One friend, <b>' . $tm->fname . '</b>.</em></small>
                        </li>';
            $output .= '</ul>';
        }

        $checks = DB::select("select * from chat_message WHERE from_user_id = '" . $to_user_id . "' AND to_user_id = '" . $from_user_id . "' AND status = '1'");
        if (count($checks) > 0) {
            DB::select("UPDATE chat_message SET status = '0' WHERE from_user_id = '" . $to_user_id . "' AND to_user_id = '" . $from_user_id . "' AND status = '1'");
        }
//        $query = "
//	UPDATE chat_message
//	SET status = '0'
//	WHERE from_user_id = '" . $to_user_id . "'
//	AND to_user_id = '" . $from_user_id . "'
//	AND status = '1'
//	";
//        $statement = $connect->prepare($query);
//        $statement->execute();
        echo $output;
    }

    public
    static function get_user_name($user_id, $connect)
    {
//        $query = "SELECT username FROM login WHERE user_id = '$user_id'";
//        $statement = $connect->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll();

//        $result = DB::select("SELECT username FROM login WHERE user_id = '$user_id'");
        $user = UserModel::find($user_id);
//        $timeline = UserModel::find($user->timeline_id);
        $result = DB::select("SELECT name FROM timelines WHERE id = '$user->timeline_id'");
        foreach ($result as $row) {
            return $row->name;
        }
    }

    public
    static function count_unseen_message($from_user_id, $to_user_id, $connect)
    {
//        $query = "
//	SELECT * FROM chat_message
//	WHERE from_user_id = '$from_user_id'
//	AND to_user_id = '$to_user_id'
//	AND status = '1'
//	";
//        $statement = $connect->prepare($query);
//        $statement->execute();
//        $count = $statement->rowCount();
        $output = '';
        $countMsg = ChatMessage::where(['from_user_id' => $from_user_id, 'to_user_id' => $to_user_id, 'status' => 1])->count();
        if ($countMsg > 0) {
            $output = '<span class="label label-success">' . $countMsg . '</span>';
        }
        return $output;
    }

    public
    static function fetch_is_type_status($user_id, $connect)
    {
//        $query = "SELECT is_type FROM login_details WHERE user_id = '" . $user_id . "' ORDER BY last_activity DESC LIMIT 1";
//        $statement = $connect->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll();
        $output = '';


        $result = DB::select("SELECT is_type FROM login_details WHERE user_id = '" . $user_id . "' ORDER BY last_activity DESC LIMIT 1");
        foreach ($result as $row) {
            if ($row->is_type == 'yes') {
                $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
            }
        }
        return $output;
    }

    public
    static function fetch_group_chat_history($connect)
    {
//        $qu```ery = "
//	SELECT * FROM chat_message
//	WHERE to_user_id = '0'
//	ORDER BY timestamp DESC
//	";
//
//        $statement = $connect->prepare($query);
//
//        $statement->execute();
//
//        $result = $statement->fetchAll();

        $result = DB::select("SELECT * FROM chat_message WHERE to_user_id = '0' ORDER BY timestamp DESC");

        $output = '<ul class="list-unstyled">';
        foreach ($result as $row) {
            $user_name = '';
            if ($row->from_user_id == $_SESSION["user_id"]) {
                $user_name = '<b class="text-success">You</b>';
            } else {
                $user_name = '<b class="text-danger">' . ChatModel::get_user_name($row->from_user_id, $connect) . '</b>';
            }

            $output .= '

		<li style="border-bottom:1px dotted #ccc">
			<p>' . $user_name . ' - ' . LaravelEmojiOneFacade::shortnameToImage($row->chat_message) . ' <div align="right">
					- <small><em>' . $row->timestamp . '</em></small>
				</div>
			</p>
		</li>
		';
        }
        $output .= '</ul>';
        echo $output;
    }


}

<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\Comments;
use App\Events\StatusLiked;
use App\Post_follows;
use App\Post_likes;
use App\Post_media;
use App\Post_spam;
use App\Post_unlikes;
use App\Posts;
use App\UserModel;
use App\UserNotifications;
use Carbon\Carbon;
use ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

session_start();

class PostController extends Controller
{
    public $data = [];

    public function post_store(Request $request)
    {
//        ini_set('memory_limit','256M');
//        echo request('posttext');
//        try {
        // $upload_file = count($_FILES['upload_file']['name']);-----
        $upload_file_video = count($_FILES['upload_file_video']['name']);
        $user = $_SESSION['user_master'];

        $newpost = new Posts();
        $newpost->description = request('description');
        $newpost->timeline_id = $user->timeline_id;
        $newpost->user_id = $user->id;
        $newpost->posted_by = $user->id;
        $newpost->description = LaravelEmojiOneFacade::toShort(request('posttext'));
        $newpost->description2 = request('posttext');
        $newpost->created_at = Carbon::now('Asia/Kolkata');;
        $newpost->checkin = request('checkin') != '' ? request('checkin') : null;
        $newpost->post_privacy = request('post_privacy_set') == 'Public' ? 'public' : 'friends';
        $newpost->save();

        if (request('post_img_src') != null) {
//                $tids = explode("=,", request('post_img_src'));
            $tids = $request->input('post_img_src');
            foreach (json_decode($tids) as $obj) {
                $post_media = new Post_media();
                $post_media->post_id = $newpost->id;
                list($type, $obj) = explode(';', $obj);
                list(, $obj) = explode(',', $obj);
                $data = base64_decode($obj); //base64_decode($data);
                $image_name = str_random(6) . '.png';
                $destinationPath = './userposts/' . $user->id . '/' . $image_name;
                $directory = "userposts/" . $user->id;
                if (!file_exists($directory)) {
                    File::makeDirectory($directory);
                }
                file_put_contents($destinationPath, $data);
                $post_media->media_url = 'userposts/' . $user->id . '/' . $image_name;
                $post_media->media_type = 'img';
                $post_media->save();
            }
        }
        /* if (request('upload_file') != null) {
             for ($i = 0; $i < $upload_file; $i++) {
                 $arr = [];
                 $i = 1;
                 $destinationPath = 'userposts/' . $user->id . '/';
                 foreach (request('upload_file') as $file) {
                     $post_media = new Post_media();
                     $post_media->post_id = $newpost->id;
                     $arr[] = $temp = str_random(6) . '_post_user_id_' . $user->id . '_' . $file->getClientOriginalName();
                     $file->move($destinationPath, $temp);
                     $i++;
                     $post_media->media_type = 'img';
                     $post_media->media_url = $destinationPath . $temp;
                     $post_media->save();
                 }
             }
         }*/
        if (request('upload_file_video') != null) {
            for ($i = 0; $i < $upload_file_video; $i++) {
                $arr = [];
                $i = 1;
                $destinationPath = 'userposts/' . $user->id . '/';
                foreach (request('upload_file_video') as $file) {
                    $post_media = new Post_media();
                    $post_media->post_id = $newpost->id;

                    $arr[] = $temp = str_random(6) . '_post_user_id_' . $user->id . '_' . $file->getClientOriginalName();
                    $file->move($destinationPath, $temp);
                    $i++;
                    $post_media->media_type = 'vd';
                    $post_media->media_url = $destinationPath . $temp;

                    $post_media->save();
                }
            }
        }
//        } catch (\Exception $ex) {
//            return $ex->getMessage();
//        }
    }

    public
    function postload()
    {
        $user = $_SESSION['user_master'];
        $limit = request('limit');
        $rowsperpage = 5;
//        $posts = Posts::where(['user_id' => $user->id])->orderBy('id', 'desc')->get();
        $sql = "select count(p.id) as post_count from posts p where p.user_id=$user->id and p.active = 1";

        $numrows = DB::select($sql);
        $totalpages = ceil($numrows[0]->post_count / $rowsperpage);
        $limit = request('limit');
        if (isset($limit) && is_numeric($limit)) {
            $currentpage = (int)$limit;
        } else {
            $currentpage = 1;  // default page number
        }

        if ($currentpage > $totalpages) {
            $currentpage = $totalpages;
        }
        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $posts = DB::select("select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, (select u.id from users u where u.id=p.user_id) as user_id, p.active from posts p where p.user_id=$user->id and p.active = 1 ORDER BY p.id DESC");
//
        $post_media = Post_media::where(['is_deleted' => 0])->get();
        $post_comments = Comments::where(['is_active' => 1])->get();
        $post_likes = Post_likes::get();

        return view('post.user_posts')->with(['posts' => $posts, 'post_comments' => $post_comments, 'post_likes' => $post_likes, 'user' => $user, 'post_count' => count($posts)]);
    }

    public function getPost()
    {
        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find($ses_user->id);
        $ses_user = UserModel::find($ses_user->id);
        $user_id = $user->id;
//        $posts = DB::select('select p.id as id, p.description, t.name, u.profile_pic, p.created_at, p.timeline_id,p.user_id from posts p, users u, timelines t where p.user_id = u.id and u.timeline_id = t.id and p.user_id = "' . $user_id . '" and p.active=1 ORDER BY p.id DESC');

        $posts1 = DB::select("select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where p.user_id=$user_id and p.active = 1 ORDER BY p.id DESC");
        $numrows = count($posts1);
        $rowsperpage = 2;
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
        $s = "select p.id as id, p.description,p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where p.user_id=$user_id and p.active = 1 ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
        $posts = DB::select($s);
        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

//                $results[] = ['id' => $post->id, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re];
                $results[] = ['id' => $post->id, 'checkin' => $post->checkin, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
            }
            return view('post.new_user_posts')->with(['post' => $results, 'user' => $user, 'ses_user' => $ses_user, 'count_post' => count($posts1)]);
        }
//        else {
//            echo json_encode("No Record Available");
//        }
    }

    public function getDashboardPost()
    {
        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find($ses_user->id);
        $user_id = $user->id;
//        $posts1 = DB::select("select p.id as id, p.description, (select t.name from timelines t where t.id=p.user_id) as name,
//p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");

        $posts1 = DB::select("select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC");

        $numrows = count($posts1);
        $rowsperpage = 1;
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
        $s = "select p.id as id, p.description,p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr, users unn where fr.status='friends' and fr.friend_id=$user_id and unn.id=fr.user_id and unn.active = 1) or p.user_id in (select f.friend_id from friends f, users un where f.status='friends' and f.user_id=$user_id and un.id= f.friend_id and un.active = 1) ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        echo $s;
        $posts = DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");


                $results[] = ['id' => $post->id, 'checkin' => $post->checkin, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
            }
            return view('post.new_dashboard_posts')->with(['post' => $results, 'user' => $user, 'count_post' => count($posts1)]);
        } else {
//            echo json_encode("No Record Available");
        }
    }

    public function show_notification_post()
    {
        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find($ses_user->id);
        $post_id = request('post_id');
        $user_id = $user->id;
        $posts = "select p.id as id, p.description,p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where p.id = $post_id and p.user_id=$user_id";
//        $posts1 = DB::select("select p.id as id, p.description, p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");
//        echo $s;
        $post = DB::selectOne($posts);
//echo $posts;
        if (isset($post) > 0) {
//            foreach ($posts as $post) {
            $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$user_id");

            $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$user_id");

            $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$user_id");

            $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$user_id");

            $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$user_id");


            $results[] = ['id' => $user_id, 'checkin' => $post->checkin, 'description' => isset($post->description) ? $post->description : '', 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
//            }
            return view('post.notification_post')->with(['post' => $results, 'user' => $user, 'count_post' => 1]);
        } else {
//            echo json_encode("No Record Available");
        }
    }

    public function getFriendPost()
    {
        $ses_user = $_SESSION['user_master'];
        $ses_user = UserModel::find($ses_user->id);
        $user = UserModel::find(request('search_user_id'));
        $user_id = $user->id; //search member id
        $friend = DB::selectOne("select f.id, f.status as status from friends f where f.status = 'friends' and (f.user_id = $user_id and f.friend_id = $ses_user->id or f.user_id = $ses_user->id and f.friend_id = $user_id)");
//        $posts1 = DB::select("select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");

        $public = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where p.post_privacy = 'public' and p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC";
        $friend_public = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where (p.post_privacy = 'public' or p.post_privacy = 'friends') and p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC";
        $posts1 = isset($friend) ? DB::select($friend_public) : DB::select($public);


//        $posts1 = DB::select("select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC");
        $numrows = count($posts1);
        $rowsperpage = 1;
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
        $s = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.post_privacy = 'public' and  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
        $q = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where (p.post_privacy = 'public' or p.post_privacy = 'friends') and  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC LIMIT $offset,$rowsperpage";
//        $old = "select p.id as id, p.description, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id ORDER BY p.id DESC LIMIT $offset,$rowsperpage";

        $final =
//        echo $s;
        $posts = isset($friend) ? DB::select($q) : DB::select($s);

        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

//                $results[] = ['id' => $post->id, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re];
                $results[] = ['id' => $post->id, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
            }
            return view('post.new_user_posts')->with(['post' => $results, 'user' => $user, 'ses_user' => $ses_user, 'count_post' => count($posts1)]);
        } else {
//            echo json_encode("No Record Available");
        }
    }


    public
    function latest_dashboard_post()
    {

        $ses_user = $_SESSION['user_master'];
        $user = UserModel::find($ses_user->id);
        $user_id = $user->id;
        $posts1 = DB::select("select p.id as id, p.description, p.checkin, (select t.name from timelines t, users u where u.id = p.user_id and t.id=u.timeline_id) as name,p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, p.active from posts p where  p.active = 1 and p.user_id=$user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=$user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=$user_id) ORDER BY p.id DESC");

        $sql = "select p.id,p.description,p.checkin,t.name,p.user_id,p.created_at,u.profile_pic,p.active from posts p,timelines t,users u where p.id=(select max(id) from posts where user_id=$user_id) and p.user_id=u.id and t.id=u.timeline_id";
        $posts = DB::select($sql);
        $results = array();
        $media_re = array();
        $comment_re = array();
        $like_re = array();
        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $media_re = DB::select("select pm.media_url,pm.media_type from post_media pm where pm.post_id=$post->id");

                $comment_re = DB::select("select c.id, c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$post->id");

                $like_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$post->id");

                $spam_re = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_spam pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$user_id");

                $dislike = DB::select("SELECT t.name, u.profile_pic, u.id FROM post_unlike pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$user_id");

                $results[] = ['id' => $post->id, 'checkin' => $post->checkin, 'description' => $post->description, 'name' => $post->name, 'profile_pic' => $post->profile_pic, 'created_at' => $post->created_at, 'user_id' => $post->user_id, 'media' => $media_re, 'comment' => $comment_re, 'like' => $like_re, 'spam' => count($spam_re), 'dislike' => count($dislike)];
            }
            return view('post.latest_post')->with(['post' => $results, 'user' => $user, 'count_post' => count($posts1)]);
        } else {
//            echo json_encode("No Record Available");
        }
//        $queryResult = DB::select("call getLatestPost($user->id)");
//        $posts = collect($queryResult);
//        return view('post.latest_post')->with(['post' => $posts, 'user_id' => $user_id]);
    }

    public
    function post_likes()
    {
        $user = $_SESSION['user_master'];
        $post_like = Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->first();
        $user_comment = UserModel::find($user->id);
        $post = Posts::find(request('post_id'));
        if (isset($post_like)) {
            $post_like->delete();
            echo 'unlike';
            $comment_by = $user_comment->timeline->name;
            $msg = "<b>$comment_by</b> is liked your post";
            UserNotifications::where(['post_id' => $post->id, 'user_id' => $post->posted_by, 'description' => $msg])->delete();
        } else {
            $post_follow = new Post_likes();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
            echo 'like';

            /******Notification*******/
            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && $user->id != $post->posted_by) {
                $comment_by = $user_comment->timeline->name;
                $title = "Post Liked";
                $message = "$comment_by is liked your post";
                $token = $user_post_by->token;
                $data = $post;
                $user_notification = new UserNotifications();
                $user_notification->post_id = $post->id;
                $user_notification->user_id = $post->posted_by;
                $user_notification->notified_by = $user->id;
                $user_notification->description = "<b>$comment_by</b> is liked your post";
                $user_notification->created_at = Carbon::now('Asia/Kolkata');
                $user_notification->save();
                //event(new StatusLiked($post->posted_by));
                AdminModel::getNotification($token, $title, $message, $data);
            }
            /******Notification*******/
            Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
            Post_unlikes::where(['post_id' => $post->id, 'user_id' => $user->id])->delete();


//        echo request('post_id');
        }
    }


    public
    function post_spam()
    {
        $user = $_SESSION['user_master'];
        $post_like = Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->first();
        if (isset($post_like)) {
            $post_like->delete();
            echo 'unspam';
        } else {
            $post_follow = new Post_spam();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
            echo 'spam';
            Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
            /******Notification*******/
            $post = Posts::find(request('post_id'));
            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && $user->id != $post->posted_by) {
                $user_comment = UserModel::find($user->id);
                $comment_by = $user_comment->timeline->name;
                $title = "Post Spam";
                $message = "$comment_by is spam your post";
                $token = $user_post_by->token;
                $data = $post;
                $user_notification = new UserNotifications();
                $user_notification->post_id = $post->id;
                $user_notification->user_id = $post->posted_by;
                $user_notification->notified_by = $user->id;
                $user_notification->description = "<b>$comment_by</b> is spam your post";
                $user_notification->created_at = Carbon::now('Asia/Kolkata');
                $user_notification->save();
                //event(new StatusLiked($post->posted_by));
                AdminModel::getNotification($token, $title, $message, $data);
            }
            /******Notification*******/
            Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
//        echo request('post_id');
        }
    }


    public
    function post_unlikes()
    {
//        $user = $_SESSION['user_master'];
//        $post_like = Post_likes::where(['post_id' => request('post_id'), 'user_id' => $user->id])->first();
//        $post_like->delete();
//        echo request('post_id');
        $user = UserModel::find($_SESSION['user_master']->id);
        $post = Posts::find(request('post_id'));
        $comment_by = ucwords($user->timeline->name);
        $post_like = Post_unlikes::where(['post_id' => $post->id, 'user_id' => $user->id])->first();
        if (isset($post_like)) {
            $post_like->delete();
            UserNotifications::where(['post_id' => $post->id, 'user_id' => $post->posted_by, 'notified_by' => $user->id, 'description' => "<b>$comment_by</b> is disliked your post"])->delete();
//            $ret['response'] = "Undisliked";
            echo 'Undisliked';
//            echo json_encode($ret);
        } else {
            $post_follow = new Post_unlikes();
            $post_follow->post_id = request('post_id');
            $post_follow->user_id = $user->id;
            $post_follow->save();
//            $ret['response'] = "Disliked";
            echo 'Disliked';
//            echo json_encode($ret);
//            $this->save_notification('liked');

            $user_post_by = UserModel::find($post->posted_by);
            if (isset($user_post_by->token) && $_SESSION['user_master']->id != $post->posted_by) {

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
//            Post_spam::where(['post_id' => request('post_id'), 'user_id' => $user->id])->delete();
            Post_likes::where(['post_id' => $post->id, 'user_id' => $user->id])->delete();

//        echo request('post_id');
        }
    }

    public
    function post_follow($post_id)
    {
        $user = $_SESSION['user_master'];
        $post_follow = new Post_follows();
        $post_follow->post_id = $post_id;
        $post_follow->user_id = $user->id;
        $post_follow->save();
    }

    public
    function post_delete($post_id)
    {
        $post = Posts::find($post_id);
        $post_media = Post_media::where(['post_id' => $post->id])->get();
        if (count($post_media) > 0) {
            foreach ($post_media as $media) {
                $image_path = $media->media_url;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
        }
        $post_like = Post_likes::where(['post_id' => $post_id])->delete();
        $post->delete();
        return Redirect::back()->with('message', 'Post has been deleted...!');
    }

    public
    function postlikelist()
    {
        $post_id = request('post_id');
//        $likes = Post_likes::where(['post_id' => $post_id])->get();
//        foreach ($likes as $like)
        $puser = DB::select("select u.id as id, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic from users u, post_likes pl where u.id = pl.user_id and pl.post_id = $post_id");

//        echo json_encode($puser);
        return view('post.like_list')->with(['puser' => $puser]);
    }

    public
    function post_comment()
    {
        $user = $_SESSION['user_master'];
        $comment = new Comments();
        $comment->post_id = request('post_id');
        $comment->description = LaravelEmojiOneFacade::toShort(request('commenttext'));
        $comment->description2 = request('commenttext');
        $comment->user_id = $user->id;
        $comment->save();

        /******Notification*******/
        $post = Posts::find(request('post_id'));
        $user_post_by = UserModel::find($post->posted_by);
        if (isset($user_post_by->token) && $user->id != $post->posted_by) {
            $user_comment = UserModel::find($user->id);
            $comment_by = $user_comment->timeline->name;
            $title = "Post Comment";
            $message = "$comment_by is commented on your post";
            $token = $user_post_by->token;
            $data = $post;
            $user_notification = new UserNotifications();
            $user_notification->post_id = $post->id;
            $user_notification->user_id = $post->posted_by;
            $user_notification->notified_by = $user->id;
            $user_notification->description = "<b>$comment_by</b> is commented on your post";
            $user_notification->created_at = Carbon::now('Asia/Kolkata');
            $user_notification->save();
//            //event(new StatusLiked($post->posted_by));
//            AdminModel::getNotification($token, $title, $message, $data);
        }
        /******Notification*******/

        return view('post.comment_list')->with(['comment' => $comment]);
    }

    public
    function get_post_comment()
    {
        $user = $_SESSION['user_master'];
        $comment = Comments::find(request('comment_id'));
        return view('post.edit_comment')->with(['comment' => $comment, 'user' => $user]);
    }

    public
    function edit_post_comment()
    {
//        $user = $_SESSION['user_master'];
        $comment = Comments::find(request('comment_id'));
        $comment->description = LaravelEmojiOneFacade::toShort(request('commenttext'));
        $comment->description2 = request('commenttext');
        $comment->save();
        echo LaravelEmojiOneFacade::shortnameToImage($comment->description);
//        return view('post.comment_list')->with(['comment' => $comment]);
    }

    public
    function getcommentlist()
    {
        $post_id = request('post_id');
        $post_comments = Comments::where(['is_active' => 1, 'post_id' => $post_id])->get();
        return view('post.comment_list')->with(['post_comments' => $post_comments]);
    }
}

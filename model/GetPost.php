<?php
require_once('BaseClass.php');

class GetPost implements \JsonSerializable
{
    private $id;
    private $description;
    private $p_username;
    private $p_user_profile;
    private $p_time;
    private $timeline_id;
    private $user_id;
    private $media = array();
    private $likes = array();
    private $comments = array();

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }


    /*********************API With Multiple Array*********************************************/
    function get_post($user_id)
    {
        try {
            $p_arrayobj = new ArrayObject();
            $obj_count = new BaseClass;
            $obj_count->dbConnect();
            $stmt_count = $obj_count->dbconn->prepare("select p.id, p.description, t.name, u.profile_pic, p.created_at, p.timeline_id,p.user_id from posts p, users u, timelines t where p.user_id = u.id and u.timeline_id = t.id and p.user_id =$user_id and p.active=1");
            $stmt_count->execute();
            $stmt_count->bind_result($id, $description, $p_username, $p_user_profile, $p_time, $timeline_id, $user_id);
            while ($stmt_count->fetch()) {
                $reg1 = new GetPost();
                $reg1->id = $id;
                $reg1->description = $description;
                $reg1->p_username = $p_username;
                $reg1->p_user_profile = $p_user_profile;
                $reg1->p_time = $p_time;
                $reg1->timeline_id = $timeline_id;
                $reg1->user_id = $user_id;
                $p_arrayobj->append($reg1);
            }
            $counter = count($p_arrayobj);
            $numrows = $counter;
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

            // if current page is greater than total pages
            if ($currentpage > $totalpages) {
// set current page to last page
                $currentpage = $totalpages;
            }
// if current page is less than first page
            if ($currentpage < 1) {
// set current page to first page
                $currentpage = 1;
            }

// the offset of the list, based on current page
            $offset = ($currentpage - 1) * $rowsperpage;

//echo $offset;
            $obj = new BaseClass;
            $obj1 = new BaseClass;
            $obj2 = new BaseClass;
            $obj3 = new BaseClass;
            $post_arrayobj = new ArrayObject();
            $postcmt = new ArrayObject();
            $postlike = new ArrayObject();
            $postmda = new ArrayObject();
            $obj->dbConnect();
            $obj1->dbConnect();
            $obj2->dbConnect();
            $obj3->dbConnect();
            $pst = $obj->dbconn->prepare("select p.id, p.description, t.name, u.profile_pic, p.created_at, p.timeline_id,p.user_id from posts p, users u, timelines t where p.user_id = u.id and u.timeline_id = t.id and p.user_id =$user_id and p.active=1 ORDER BY p.id DESC LIMIT $offset, $rowsperpage");
            $pst->execute();
            $pst->bind_result($id, $description, $p_username, $p_user_profile, $p_time, $timeline_id, $user_id);

            while ($pst->fetch()) {
                $reg = new GetPost();
                $reg->id = $id;
                $reg->description = $description;
                $reg->p_username = $p_username;
                $reg->p_user_profile = $p_user_profile;
                $reg->p_time = $p_time;
                $reg->timeline_id = $timeline_id;
                $reg->user_id = $user_id;


                $medeaarr = [];
                $mst = $obj1->dbconn->prepare("select pm.media_url from post_media pm where pm.post_id=$id");
                $mst->execute();
                $mst->bind_result($media);
                while ($mst->fetch()) {
                    $medeaarr['media'] = $media;
                    $postmda[] = $medeaarr;
                }
                $reg->media[] = $postmda;
                $mst->close();

                $likearr = [];
                $like = $obj2->dbconn->prepare("SELECT t.name, u.profile_pic, u.id FROM post_likes pl, users u, timelines t WHERE pl.user_id = u.id and u.timeline_id = t.id and pl.post_id=$id");
                $like->execute();
                $like->bind_result($like_name, $like_profile, $uid);
                while ($like->fetch()) {
                    $likearr['user_name'] = $like_name;
                    $likearr['profile'] = $like_profile;
                    $likearr['like_uid'] = $uid;
                    $postlike->append($likearr);
                }
                $reg->likes[] = $postlike;
                $like->close();

                $arr = [];
                $comment = $obj3->dbconn->prepare("select c.user_id, t.name, u.profile_pic, c.description from comments c, users u, timelines t where c.user_id = u.id and u.timeline_id = t.id and c.post_id=$id");
                $comment->execute();
                $comment->bind_result($cuid, $username, $profile, $comments);
                while ($comment->fetch()) {
                    $arr['c_uid'] = $cuid;
                    $arr['user_name'] = $username;
                    $arr['profile'] = $profile;
                    $arr['comment'] = $comments;
                    $postcmt->append($arr);
                }
                $reg->comments[] = $postcmt;
                $comment->close();
                $post_arrayobj->append($reg);
            }
            $pst->close();
            return $post_arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }
    /*********************API With Multiple Array*********************************************/

}
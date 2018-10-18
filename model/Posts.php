<?php
require_once('BaseClass.php');

class Posts implements \JsonSerializable
{
    private $id;
    private $post_id;
    private $user_id;
    private $description;

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


    /*********************Post Like/Comments*********************************************/
    function insert_like()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            if (isset($_GET['post_id']))
                $post_id = $_GET['post_id'];

            if (isset($_GET['user_id']))
                $user_id = $_GET['user_id'];

            $stmt = $obj->dbconn->prepare("select id,post_id,user_id from post_likes where post_id = ? and user_id = ?");
            $stmt->bind_param("ii", $post_id, $user_id);
            $stmt->execute();
            $stmt->bind_result($id, $post_id, $user_id);
            $stmt->fetch();
            $stmt->close();

            if ($id != null) {
                $qry = "DELETE FROM post_likes WHERE id = ?";
                $stmt_ = $obj->dbconn->prepare($qry);
                $stmt_->bind_param('i', $id);
                $stmt_->execute();
                $ret = "Unliked";
                $stmt_->close();
            } else {
                $stmt_in = $obj->dbconn->prepare("insert into post_likes(post_id,user_id) values(?,?)");
                $stmt_in->bind_param("ii", $this->post_id, $this->user_id);
                $stmt_in->execute();
                $ret = "Liked";
                $stmt_in->close();
            }
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }

    function insert_comments()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("insert into comments(post_id,user_id,description) values(?,?,?)");
            $stmt->bind_param("iis", $this->post_id, $this->user_id, $this->description);
            $stmt->execute();
            $ret = $stmt->affected_rows;
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }
    /*********************Post Like/Comments*********************************************/

}
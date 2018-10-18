<?php
require_once('BaseClass.php');

class UserList implements \JsonSerializable
{
    private $id;
    private $name;
    private $pic;

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

    function get_users()
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select u.id, t.name, u.profile_pic from users u, timelines t where u.timeline_id = t.id");
            $stmt->execute();
            $stmt->bind_result($id, $name, $pic);
            while ($stmt->fetch()) {
                $reg = new UserList();
                $reg->id = $id;
                $reg->name = $name;
                $reg->pic = $pic;
                $arrayobj->append($reg);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }


}
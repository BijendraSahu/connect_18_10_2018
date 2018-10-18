<?php
require_once('BaseClass.php');

class Country implements \JsonSerializable
{
    private $id;
    private $country;

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

    function get_country()
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select id, nicename from countries");
            $stmt->execute();
            $stmt->bind_result($id, $country);
            while ($stmt->fetch()) {
                $reg = new Country();
                $reg->id = $id;
                $reg->country = $country;
                $arrayobj->append($reg);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }


}
<?php
require_once('BaseClass.php');

class BusinessType implements \JsonSerializable
{
    private $ID;
    private $BusinessTypeName;
    private $IsActive;

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

    function insert_business_type()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("insert into business_type(BusinessTypeName) values(?)");
            $stmt->bind_param("s", $this->BusinessTypeName);
            $stmt->execute();
            $ret = $stmt->affected_rows;
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }

    function get_all_business_type()
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select ID, BusinessTypeName, IsActive  from business_type");
            $stmt->execute();
            $stmt->bind_result($ID, $BusinessTypeName, $IsActive);
            while ($stmt->fetch()) {
                $business_type = new BusinessType();
                $business_type->ID = $ID;
                $business_type->BusinessTypeName = $BusinessTypeName;
                $business_type->IsActive = $IsActive;
                $arrayobj->append($business_type);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }

    function get_business_type($ID)
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select ID, BusinessTypeName, IsActive from business_type where ID=?");
            $stmt->bind_param("i", $ID);
            $stmt->execute();
            $stmt->bind_result($ID, $BusinessTypeName, $IsActive);
            while ($stmt->fetch()) {
                $business_type = new BusinessType();
                $business_type->ID = $ID;
                $business_type->BusinessTypeName = $BusinessTypeName;
                $business_type->IsActive = $IsActive;
                $arrayobj->append($business_type);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }

    function update_business_type()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $ID = $_GET["ID"];

            if (isset($_GET['BusinessTypeName']))
                $BusinessTypeName = $_GET["BusinessTypeName"];


            $qry = "UPDATE business_type set BusinessTypeName=? WHERE ID=?";
            $stmt = $obj->dbconn->prepare($qry);
//            echo $qry;
            $stmt->bind_param("si", $BusinessTypeName, $ID);
            $stmt->execute();
            $ret = $stmt->affected_rows;
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }

    function active_business_type()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $ID = $_GET["ID"];

            if (isset($_GET['IsActive']))
                $IsActive = $_GET["IsActive"];

            $qry = "UPDATE business_type set IsActive=? WHERE ID=?";
            $stmt = $obj->dbconn->prepare($qry);
//            echo $qry;
            $stmt->bind_param("ii", $IsActive, $ID);
            $stmt->execute();
            $ret = $stmt->affected_rows;
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }


    function delete_business_type()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $ID = $_GET["ID"];
            $qry = "DELETE FROM business_type WHERE ID = ?";
            $stmt = $obj->dbconn->prepare($qry);
            $stmt->bind_param('i', $ID);
            $stmt->execute();
            $ret = $stmt->affected_rows;
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }
}
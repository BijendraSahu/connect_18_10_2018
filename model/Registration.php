<?php
require_once('BaseClass.php');

class Registration implements \JsonSerializable
{
    private $id;
    private $rc;
    private $fname;
    private $lname;
    private $email;
    private $contact;
    private $password;
    private $country_id;
    private $city;
    private $birthday;
    private $gender;
    private $otp;
    private $profile_pic;
    private $verified;
    private $member_type;

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

    function insert_reg()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();
            $otp = rand(100000, 999999);
            $password = md5($this->password);
            $rc =  "rc" . rand(10000000, 99999999);
            $name = $this->fname . " " . $this->lname;
            $stmt = $obj->dbconn->prepare("CALL reg(?,?,?,?,?,?,?,?,?,?,?,?)");
//            $stmt = $obj->dbconn->prepare("insert into users(email,contact,birthday,password,country_id,city) values(?,?,?,?,?,?)");
            $stmt->bind_param("sssssissssss", $this->fname, $this->lname, $this->email, $this->contact, $password, $this->country_id, $this->city, $this->birthday, $name, $otp, $this->gender, $rc);
            $stmt->execute();
            $ret = $stmt->affected_rows;
//            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$this->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$this->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            $stmt->close();
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }

    function check_mobile()
    {
        try {
            $obj = new BaseClass;
            $obj->dbConnect();

            if (isset($_GET['contact']))
                $contact = $_GET["contact"];

            if (isset($_GET['email']))
                $email = $_GET['email'];

            if (!isset($_GET['contact'])) {
                $stmt = $obj->dbconn->prepare("select id, email from users where email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($id, $email);
                $stmt->fetch();
                $stmt->close();

                if ($id != null) {
                    $ret = 1;
                } else $ret = 0;
            } else {
                $stmt = $obj->dbconn->prepare("select id, contact from users where contact = ?");
                $stmt->bind_param("s", $contact);
                $stmt->execute();
                $stmt->bind_result($id, $contact);
                $stmt->fetch();
                $stmt->close();

                if ($id != null) {
                    $ret = 1;
                } else $ret = 0;
            }
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }
        return $ret;
    }

    function get_all_reg()
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select u.id, u.rc, t.fname, t.lname, u.email, u.contact, u.birthday, u.country_id, u.city, u.gender, u.verified, u.otp, u.profile_pic from users u, timelines t where t.id = u.timeline_id");
            $stmt->execute();
            $stmt->bind_result($id, $rc, $fname, $lname, $email, $contact, $birthday, $country_id, $city, $gender, $verified, $otp, $profile_pic);
            while ($stmt->fetch()) {
                $user = new Registration();
                $user->id = $id;
                $user->rc = $rc;
                $user->fname = $fname;
                $user->lname = $lname;
                $user->email = $email;
                $user->contact = $contact;
                $user->birthday = $birthday;
                $user->country_id = $country_id;
                $user->city = $city;
                $user->gender = $gender;
                $user->verified = $verified;
                $user->otp = $otp;
                $user->profile_pic = $profile_pic;
                $arrayobj->append($user);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }

    function get_user($id)
    {
        try {
            $obj = new BaseClass;
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $stmt = $obj->dbconn->prepare("select u.id, u.rc, t.fname, t.lname, u.email, u.contact, u.birthday, u.country_id, u.city, u.gender, u.verified, u.otp, u.profile_pic  from users u, timelines t where u.timeline_id = t.id and u.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $rc, $fname, $lname, $email, $contact, $birthday, $country_id, $city, $gender, $verified, $otp, $profile_pic);
            while ($stmt->fetch()) {
                $user = new Registration();
                $user->id = $id;
                $user->rc = $rc;
                $user->fname = $fname;
                $user->lname = $lname;
                $user->email = $email;
                $user->contact = $contact;
                $user->birthday = $birthday;
                $user->country_id = $country_id;
                $user->city = $city;
                $user->gender = $gender;
                $user->verified = $verified;
                $user->otp = $otp;
                $user->profile_pic = $profile_pic;
                $arrayobj->append($user);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }

    function verify_otp()
    {
        try {
            $obj = new BaseClass();
            $obj->dbConnect();

            if (isset($_GET['otp']))
                $otp = $_GET['otp'];

            $stmt = $obj->dbconn->prepare("select id, verified from users where otp = ?");
            $stmt->bind_param("s", $otp);
            $stmt->execute();
            $stmt->bind_result($id, $verified);
            $stmt->fetch();
            $stmt->close();

            if ($id != null) {
                $verified = 1;
                $qry = "UPDATE users set verified=? WHERE id=?";
                $stmt_ = $obj->dbconn->prepare($qry);
                $stmt_->bind_param("ii", $verified, $id);
                $stmt_->execute();
                $ret = $stmt_->affected_rows;
                $stmt_->close();
                return $ret;

            }
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }

    }

    function resend_otp()
    {
        try {
            $obj = new BaseClass();
            $obj->dbConnect();

//            if (isset($_GET['contact']))
            $contact = $_GET["contact"];
            $otp = rand(100000, 999999);

            $qry = "UPDATE users set otp = ? WHERE contact = ?";

            $stmt = $obj->dbconn->prepare($qry);
            $stmt->bind_param("ss", $otp, $contact);
            $stmt->execute();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$contact&message=Dear%20user,%20OTP%20to%20verify%20your%20connectingone%20account%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20verify%20your%20connectingone%20account%20is%20$otp");

//                $ret = $stmt->affected_rows;
            $stmt->close();
            $ret = 1;
        } catch (Exception $ex) {
            $ret = "Caught exception: " . $ex->getMessage();
        }

        return $ret;
    }

    function login($email, $password)
    {
        try {
            $obj = new BaseClass();
            $arrayobj = new ArrayObject();
            $obj->dbConnect();
            $email_id = $email;
            $pass = md5($password);
            $stmt = $obj->dbconn->prepare("select u.id, u.rc, t.fname, t.lname, u.email, u.contact, u.birthday, u.country_id, u.city, u.gender, u.verified, u.otp, u.profile_pic, u.member_type from users u, timelines t where u.timeline_id = t.id and u.email = ? and u.password = ?");
            $stmt->bind_param("ss", $email_id, $pass);
            $stmt->execute();
            $stmt->bind_result($id, $rc, $fname, $lname, $email, $contact, $birthday, $country_id, $city, $gender, $verified, $otp, $profile_pic, $member_type);
            while ($stmt->fetch()) {
                $user = new Registration();
                $user->id = $id;
                $user->rc = $rc;
                $user->fname = $fname;
                $user->lname = $lname;
                $user->email = $email;
                $user->contact = $contact;
                $user->birthday = $birthday;
                $user->country_id = $country_id;
                $user->city = $city;
                $user->gender = $gender;
                $user->verified = $verified;
                $user->otp = $otp;
                $user->profile_pic = $profile_pic;
                $user->member_type = $member_type;
                $arrayobj->append($user);
            }
            $stmt->close();
            return $arrayobj;
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }
}

?>
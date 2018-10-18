<?php

class BaseClass
{
    private $host = "localhost";
    private $dbname = "connectonedb";
    private $uname = "onecon";
    private $pass = 'onecon@123#';
    public function dbConnect()
    {
        try {
            $this->dbconn = new mysqli($this->host, $this->uname, $this->pass, $this->dbname);
            $this->dbconn->query("SET NAMES 'utf8'");
            if (mysqli_connect_errno()) {
                echo "Connect failed";
                exit();
            }
        } catch (Exception $ex) {
            echo "Caught exception: " . $ex->getMessage();
        }
    }
}

?>
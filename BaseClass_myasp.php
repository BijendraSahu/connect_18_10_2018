<?php

class BaseClass
{
    private $host = "mysql6002.site4now.net";
    private $dbname = "db_a38573_connect";
    private $uname = "a38573_connect";
    private $pass = 'connect1';
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
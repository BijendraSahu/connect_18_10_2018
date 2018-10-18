<?php
$con=mysqli_connect("localhost","root","") OR die('check your connection parameters');
$db_name="connecting_one";
mysqli_select_db($con, $db_name);
?>

<?php
// If session already started, remove the below statement.
session_start();
// Add Database connection here

//$con=mysqli_connect("localhost","root","") OR die('check your connection parameters');
//$db_name="connect";
$con = mysqli_connect("localhost", "onecon", "onecon@123#") OR die('check your connection parameters');
$db_name = "connectonedb";
mysqli_select_db($con, $db_name);
/**/

//This api will returns indiviual commission earned
/*
    Send GET request with parameter "a" in querystring, Where "a"  holds User ID
	
	
	http://domainname.com/earning_source.php?a=user_id
	
	Example:
	http://domainname.com/earning_source.php?a=24
	
	
*/

if (!empty($_REQUEST['a'])) {

    function earningSource($userID, $con)
    {
        $q_getRecords = mysqli_query($con, "SELECT ParentID, Com, SourceID FROM coms WHERE ParentID='$userID'");
        $ar_json = array();
        while ($d = mysqli_fetch_array($q_getRecords)) {
            $q_getPic_and_tlmnID = mysqli_query($con, "SELECT profile_pic, timeline_id FROM users WHERE id=$d[2]");
            $getProfilePicture_and_ID = mysqli_fetch_array($q_getPic_and_tlmnID);

            $q_UserName = mysqli_query($con, "SELECT fname, lname FROM timelines WHERE id=$getProfilePicture_and_ID[1]");
            $getUserName = mysqli_fetch_array($q_UserName);

            $ar[] = array(
                'FirstName' => $getUserName['fname'],
                'LastName' => $getUserName['lname'],
                'ProfilePicture' => $getProfilePicture_and_ID['profile_pic'],
                'MyID' => $d['ParentID'],    // UserID
                'SourceID' => $d['SourceID'], // Commision earned from
                'Earned_amount' => $d['Com']

            );
            array_push($ar_json, $ar);
        } /**/
        $ret['response'] = $ar;
        echo json_encode($ret);
    }

    earningSource($_REQUEST['a'], $con);

}
		
		

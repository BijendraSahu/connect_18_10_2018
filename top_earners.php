<?php
// If session already started, remove the below statement.
// NO parameter required while API invocation
session_start();
// Add Database connection here
$con=mysqli_connect("localhost","onecon","onecon@123#") OR die('check your connection parameters');
$db_name="connectonedb";
mysqli_select_db($con, $db_name);

function topEarners($RowCountLimit, $con){
    $q_getTopEarners = mysqli_query($con,"SELECT  ParentID as UserID, SUM(Com) as TotalEarnings FROM coms GROUP BY ParentID LIMIT $RowCountLimit");
    $ar_json = array();
    while ($d = mysqli_fetch_array($q_getTopEarners)) {

        $q_getPic_and_tlmnID =  mysqli_query($con,"SELECT profile_pic, timeline_id FROM users WHERE id=$d[0]");
        $getProfilePicture_and_ID = mysqli_fetch_array($q_getPic_and_tlmnID);

        $q_UserName =  mysqli_query($con,"SELECT fname, lname FROM timelines WHERE id=$getProfilePicture_and_ID[1]");
        $getUserName = mysqli_fetch_array($q_UserName);

        $ar[] = array(
            'FirstName'=>$getUserName['fname'],
            'LastName'=>$getUserName['lname'],
            'ProfilePicture'=>$getProfilePicture_and_ID['profile_pic'],
            'UserID'=>$d['UserID'],
            'TotalEarnings'=>$d['TotalEarnings']

        );
//        array_push($ar_json, $ar);
    }
    $ret['response'] = $ar;

    echo json_encode($ret);
}
topEarners(10, $con);
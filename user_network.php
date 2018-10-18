<?php
// If session already started, remove the below statement.
session_start();
// Add Database connection here
$con=mysqli_connect("localhost","onecon","onecon@123#") OR die('check your connection parameters');
$db_name="connectonedb";

//$con=mysqli_connect("localhost","root","") OR die('check your connection parameters');
//$db_name="connecting_one";
mysqli_select_db($con, $db_name);



//This api will return child members
/*
    Send GET request with parameter "a" in querystring, Where "a"  holds User ID

	//###Returns TotalMembers count:


	//###Example:

	http://domainname.com/user_network.php?a=user_id


*/

if(!empty($_REQUEST['a'])){

    function getChilds($userID, $con){
        $q_getRc_byUID = mysqli_query($con,"SELECT rc FROM users WHERE id='$userID'");
        $getUserRC = mysqli_fetch_array($q_getRc_byUID)['rc'];
        if(empty($getUserRC))
            echo json_encode(array('networklist' => []));
        else{
            $q_getChildsByParentID  = mysqli_query($con,"SELECT child_id, id FROM relations WHERE parent_id='$getUserRC'");
            $ar_json = array();

            while($getChildsByParentID = mysqli_fetch_array($q_getChildsByParentID)){


                $q_getUserDetailsByID = mysqli_query($con,"SELECT t.fname,t.lname,u.profile_pic,u.id FROM timelines t, users u WHERE t.id='$getChildsByParentID[0]' and u.timeline_id = t.id");
                $ud = mysqli_fetch_array($q_getUserDetailsByID);

                // count members
                $q_getParentReferalID = mysqli_query($con,"SELECT rc FROM users WHERE id=$getChildsByParentID[0]");
                $g_rc = mysqli_fetch_array($q_getParentReferalID);
                $q_mbmrcnt = mysqli_query($con,"SELECT COUNT(id) FROM relations WHERE parent_id='$g_rc[0]'");
                $mbmrcnt = mysqli_fetch_array($q_mbmrcnt);
                $ar = array(
                    'UserID'=>$ud['id'],
                    'FirstName'=>$ud['fname'],
                    'LastName'=>$ud['lname'],
                    'ImageID'=>$ud['profile_pic'],
                    'MemberCount'=>$mbmrcnt[0],
                );
                array_push($ar_json, $ar);
            }

            echo json_encode(array('networklist' => $ar_json));


        }
    }
    getChilds($_REQUEST['a'], $con);

}

<?php
// If session already started, remove the below statement.
session_start();
//This api will create an entry in com table.
/*
    Send GET request with parameter "a" in querystring, Where "a" is key and its
	value will be Payment Status.

	Example:
	
	http://domainname.com/comission.php?a=1
	http://domainname.com/comission.php?a=0
	
	Here, a=1 represents successful transaction
	and a=0 represents transaction failure.
	
	Status:
	
	Returns true if successful
	Returns false if 
	 1) no transaction is done
	 2) transaction is done and no referral code is used
	
*/
$trans_status = $_REQUEST['a'];
if ($trans_status == 0) {
    return response()->json(array('status' => 'false'));
} else {

    /*-------------MLM Commision Started---------------*/
    // Get Referral code from Session
    $rfrcd = $_SESSION['user_master']['rc'];
    $id = $_SESSION['user_master']['id'];

    // Get Parent ID from registered Email ID
    $PrntRfrID = $rltn::select('parent_id')->where('child_id', $id)->get()->first();
    $rfrcd = $PrntRfrID->parent_id;
    if (!empty($rfrcd)) {
        // Commision Starts here... //

        $amnt = 0.5;
        $cmnsn = 0;

        $com = new com();
        while (1) {
            // Get Parent ID By Referral ID FROM User
            $regID0 = $user::select('id')->where('rc', $rfrcd)->get()->first();

            // Exit loop, if no Id From users found
            if (!isset($regID0->id))
                break;
            $user_Reg_ID0 = $regID0->id;

            // GET ChildID FROM relations by Parent ID from rgs
            $getRfrID = $rltn::select('parent_id')->where('child_id', $user_Reg_ID0)->get()->first();

            // Divide each comission part in equal halves (amnt/2)
            $cmsn = $amnt / 2;

            $add_usr_cmsn = array('SourceID' => $id, 'ParentID' => $user_Reg_ID0, 'Com' => $cmsn);
            DB::table('coms')->insert($add_usr_cmsn);
            $amnt = $cmsn; // assign comission to amount
            if (!isset($getRfrID->parent_id)) {

                return response()->json(array('status' => 'true'));
                break;
            }
            $rfrcd = $getRfrID->parent_id;
        }
    } else
        return response()->json(array('status' => 'false'));
}
/*-------------MLM Commision Ends--------------*/

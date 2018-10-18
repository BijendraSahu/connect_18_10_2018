<?php
// If session already started, remove the below statement.
session_start();
//This api will create an entry in relation table.
/*
    Send GET request with parameter "a" in querystring, Where "a" is key and its
	value will be a referal code.

	Example:
	
	http://domainname.com/create_relation.php?a=referalcode
	http://domainname.com/create_relation.php?a=123
	
	Here, 123 is referal code.
	
*/

		/*-------------MLM  Started---------------*/
		// MLM Starts here... //
		// Check if referal code is present
		$rfrcd = $_REQUEST['a'];
		if(!empty($rfrcd)){
		// Get ID from registered Email ID
		$regID  =  $user::select('id')->where('email',request('email'))->get()->first();
		$user_Reg_ID = $regID->id;
		// parent_id is referal_id here, Usinf Id as referal_id
		$add_rltns = array('parent_id'=>$rfrcd,'child_id'=>$user_Reg_ID);
		DB::table('relations')->insert($add_rltns);
		}
		/*-------------MLM  Ends---------------*/


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TestApp\Timeline;
use TestApp\UserModel;
use TestApp\Country;
use TestApp\relation;
use TestApp\com;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
session_start();
class ComissionController extends Controller
{
	// $id is user ID
	// $rfrcd is referralcode
   public function makeRelation($id, $rfrcd){
		
	/*-------------MLM Commision Started---------------*/
			
			// Get Parent ID from registered Email ID
			$PrntRfrID  =  $rltn::select('parent_id')->where('child_id',$id)->get()->first();
			$rfrcd = $PrntRfrID->parent_id;
			if(!empty($rfrcd))
			{
				// Commision Starts here... //
			
				$amnt = 0.5;
				$cmnsn = 0;
				
				$com = new com();
				while(1)
				{
					// Get Parent ID By Referral ID FROM User
					$regID0  =  $user::select('id')->where('rc',$rfrcd)->get()->first();
					
					// Exit loop, if no Id From users found
					if(!isset($regID0->id))
						break;
					$user_Reg_ID0 = $regID0->id;
					
					// GET ChildID FROM relations by Parent ID from rgs
					$getRfrID  =  $rltn::select('parent_id')->where('child_id',$user_Reg_ID0)->get()->first();
					
					// Divide each comission part in equal halves (amnt/2)
					$cmsn = $amnt/2;
					
					$add_usr_cmsn = array('SourceID'=>$id,'ParentID'=>$user_Reg_ID0, 'Com'=>$cmsn);
					DB::table('coms')->insert($add_usr_cmsn);
					$amnt =  $cmsn; // assign comission to amount
					if(!isset($getRfrID->parent_id)){
						// Update relation table column status with 1 here.
						// which means payment is done.
						
						break;
					}
					
					$rfrcd = $getRfrID->parent_id;
				}
			}
	
	}
	
	
}

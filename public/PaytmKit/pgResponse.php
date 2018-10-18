Please wait, It will automatically take you back.<br/>
<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
session_start();
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

echo "<b>Following are the transaction details:</b><br/>";
if (isset($_POST) && count($_POST)>0 )
	{ 
		
		$RESPCODE = '';
		$RESPMSG = '';
		$MID = '';
		$TXNAMOUNT = '';
		$ORDERID = '';
		$TXNID = '';
		$CHECKSUMHASH = '';
		$STATUS = '';
		foreach($_POST as $paramName => $paramValue) {
			echo "<br/>" . $paramName . " = " . $paramValue;
			if($paramName == 'STATUS')
				$STATUS = $paramValue; 
			if($paramName == 'RESPCODE')
				$RESPCODE = $paramValue; 
			if($paramName == 'RESPMSG')
				$RESPMSG  = $paramValue; 
			if($paramName == 'MID')
				$MID = $paramValue; 
			if($paramName == 'TXNAMOUNT')
				$TXNAMOUNT = $paramValue; 
			if($paramName == 'ORDERID')
				$ORDERID = $paramValue;
			if($paramName == 'TXNID')
				$TXNID = $paramValue; 
			if($paramName == 'CHECKSUMHASH')
				$CHECKSUMHASH = $paramValue; 
		
		}// foreach
}
// Used in Payment Paytm controller for status verification
$_SESSION["transaction_status"] = $_POST["STATUS"];
if($isValidChecksum == "TRUE") {
	echo "<br/><b>Checksum matched </b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		
		////////////////////////////////
		addPayTM_TransactionDetails($STATUS,$RESPCODE,$TXNAMOUNT,$ORDERID,$TXNID,$CHECKSUMHASH,$_SESSION["UID"],$RESPMSG,$MID);
		updatePaymentStatus($_SESSION["UID"], 'PayTM', $TXNID);	
		////////////////////////////////	
			
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
		////////////////////////////////
		addPayTM_TransactionDetails($STATUS,$RESPCODE,$TXNAMOUNT,$ORDERID,$TXNID,$CHECKSUMHASH,$_SESSION["UID"],$RESPMSG,$MID);
		////////////////////////////////	

	}

	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
	addPayTM_TransactionDetails($STATUS,$RESPCODE,$TXNAMOUNT,$ORDERID,$TXNID,$CHECKSUMHASH,$_SESSION["UID"],$RESPMSG,$MID);
}

function addPayTM_TransactionDetails($STATUS,$RESPCODE,$TXNAMOUNT,$ORDERID,$TXNID,$CHECKSUMHASH,$user_id,$RESPMSG,$MID){
		include('../connect_db.php');
		$q = "INSERT INTO paytm(Status, RESPCODE, RESPMSG, MID, TXNAMOUNT, ORDERID, TXNID, CHECKSUMHASH, UserID) VALUES('" . $STATUS . "','" . $RESPMSG . "','" .  $RESPCODE  . "','" . $MID  . "','" . $TXNAMOUNT  . "','" . $ORDERID  . "','" . $TXNID  . "','" . $CHECKSUMHASH  . "','" . $user_id ."')";
		mysqli_query($con,$q);

}
function updatePaymentStatus($user_id, $gateway, $t_id){
		include('../connect_db.php');
		$q = "UPDATE relations SET PaymentStatus=1,Gateway='" . $gateway . "',t_id='" . $t_id ."' WHERE child_id='" . $user_id . "'";
		mysqli_query($con,$q);
		
		$q = "UPDATE users SET member_type='paid' WHERE id="  . $user_id;
		mysqli_query($con,$q);
}
?>
<script>
function rBck(){
	window.location = 'http://www.connecting-one.com/paytm-transaction-details';
}
setTimeout(rBck, 10000);
</script>
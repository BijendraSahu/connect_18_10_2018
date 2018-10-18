<?php
//session_start();
	if(!empty($status))
	{
		echo "Status - " . $status . '<br/>';
	}
	if(!empty($firstname))
	{
		echo  "Name - " . $firstname . '<br/>';
	}
	if(!empty($amount))
	{
		echo  "Amnt - " . $amount . '<br/>';
	}
	if(!empty($txnid))
	{
		echo  "Txnid - " . $txnid . '<br/>';
	}
	if(!empty($hash))
	{
		echo  "Hash - " . $hash . '<br/>';
		echo  "Posted Hash - " . $_SESSION['pstd_hsh'] . '<br/>';
		echo  "Posted Hash controller- " . $_SESSION['pstd_hsh_cntrl'] . '<br/>';
	}
	if(!empty($key))
	{
		echo  "Key - " . $key . '<br/>';
	}
	if(!empty($productinfo))
	{
		echo  "Product - " . $productinfo . '<br/>';
	}
	if(!empty($email))
	{
		echo  "Email - " . $email . '<br/>';
	}
	
	
	If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	} else {
       // $retHashSeq = $salt.'|'.$status.'|||||||||||'.$key;
        $retHashSeq = $key.'|'. $txnid.'|'. $amount.'|'. $productinfo.'|'. $firstname.'|'. $email.'|'. $salt;
		echo "<br/>2";
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $_SESSION['pstd_hsh']) {
	       echo "Invalid Transaction. Please try again";
		   } else {
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		   }
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);

$transactionId = rand(1, 1000000);
$name = isset($_POST['firstname']) ? $_POST['firstname'] : '-';
$email = isset($_POST['email']) ? $_POST['email'] : '-';
$contact = isset($_POST['phone']) ? $_POST['phone'] : '-';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '0';
$address = isset($_POST['addressdel']) ? $_POST['addressdel'] : '-';
$rfrl_box = $_POST['address_id'];
$rfrl_box = $_POST['rfrl_ptymbox'];

require_once 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("live");
$transactionRequest->setLogin(60539);
$transactionRequest->setPassword("CONNECTING@123");
$transactionRequest->setProductId("CONNECTING");
$transactionRequest->setAmount($amount);
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount($amount);
$transactionRequest->setReturnUrl("https://www.connecting-one.com/e_atom_payment");
$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName($name);
$transactionRequest->setCustomerEmailId($email);
$transactionRequest->setCustomerMobile($contact);
$transactionRequest->setCustomerBillingAddress($address);
$transactionRequest->setCustomerAccount("-");
$transactionRequest->setReqHashKey("93559c77563068dc13");


$url = $transactionRequest->getPGUrl();

header("Location: $url");
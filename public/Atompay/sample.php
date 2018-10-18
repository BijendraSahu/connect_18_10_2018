<?php
date_default_timezone_set('Asia/Calcutta');
$datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);

$transactionId = rand(1, 1000000);
$name = isset($_POST['firstname']) ? $_POST['firstname'] : '-';
$email = isset($_POST['email']) ? $_POST['email'] : '-';
$contact = isset($_POST['phone']) ? $_POST['phone'] : '-';
$rfrl_box = $_POST['rfrl_ptymbox'];

require_once 'TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("live");
$transactionRequest->setLogin(60539);
$transactionRequest->setPassword("CONNECTING@123");
$transactionRequest->setProductId("CONNECTING");
$transactionRequest->setAmount(1);
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionAmount(1);
$transactionRequest->setReturnUrl("https://www.connecting-one.com/atom_payment");
$transactionRequest->setClientCode(123);
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setCustomerName($name);
$transactionRequest->setCustomerEmailId($email);
$transactionRequest->setCustomerMobile($contact);
$transactionRequest->setCustomerBillingAddress($rfrl_box);
$transactionRequest->setCustomerAccount("-");
$transactionRequest->setReqHashKey("93559c77563068dc13");


$url = $transactionRequest->getPGUrl();

header("Location: $url");
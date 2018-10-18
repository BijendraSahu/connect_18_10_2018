<?php
require_once("model/Registration.php");
if (isset($_GET['id']))
    $id = $_GET["id"];
if (isset($_GET['email']))
    $email = $_GET["email"];
if (isset($_GET['password']))
    $password = $_GET["password"];
if (isset($_GET['contact']))
    $contact = $_GET["contact"];

if ($_GET['service'] == 'insert_reg') {
    $registration = new Registration();
    $registration->rc = $_GET['rc'];
    $registration->fname = $_GET['fname'];
    $registration->lname = $_GET['lname'];
    $registration->email = $_GET['email'];
    $registration->contact = $_GET['contact'];
    $registration->birthday = $_GET['birthday'];
    $registration->password = $_GET['password'];
    $registration->country_id = $_GET['country_id'];
    $registration->city = $_GET['city'];
    $registration->gender = $_GET['gender'];
    $ret['response'] = $registration->insert_reg();
    print json_encode($ret);
} elseif ($_GET['service'] == 'check_exist') {
    $registration = new Registration();
//    $registration->email = $_GET['email'];
//    $registration->contact = $_GET['contact'];
    $ret['response'] = $registration->check_mobile();
    echo json_encode($ret);
} elseif ($_GET['service'] == 'get_all_reg') {
    $reg = new Registration();
    $response = $reg->get_all_reg();
    if ($response->count() > 0) {
        $arr = [];
        foreach ($response as $data) {
            $arr[] = $data;
        }
        $ret['response'] = $arr;
        echo json_encode($ret);
    } else {
        $ret['response'] = 0;
        echo json_encode($ret);
    }
} elseif ($_GET['service'] == 'get_user') {
    $reg = new Registration();
    $response = $reg->get_user($id);
    if ($response->count() > 0) {
        $arr = [];
        foreach ($response as $data) {
            $arr[] = $data;
        }
        $ret['response'] = $arr;
        echo json_encode($ret);
    } else {
        $ret['response'] = 0;
        echo json_encode($ret);
    }
} elseif ($_GET['service'] == 'verify_otp') {
    $verify = new Registration();
    $ret['response'] = $verify->verify_otp();
    echo json_encode($ret);
} elseif ($_GET['service'] == 'resend_otp') {
    $registration = new Registration();
//        $registration->Mobile = $_GET['Mobile'];
//        $registration->otp = $_GET['otp'];
    $ret['response'] = $registration->resend_otp();
    echo json_encode($ret);

} elseif ($_GET['service'] == 'login') {
    $registration = new Registration();
    $response = $registration->login($email, $password);
    if ($response->count() > 0) {
        $arr = [];
        foreach ($response as $data) {
            $arr[] = $data;
        }
        $ret['response'] = $arr;
        echo json_encode($ret);
    } else {
        $ret['response'] = 0;
        echo json_encode($ret);
    }
} else {
    $ret['response'] = 0;
    echo json_encode($ret);
}
?>
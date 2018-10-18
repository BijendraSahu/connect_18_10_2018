<?php
require_once("model/UserList.php");

if ($_GET['service'] == 'get_user') {
$registration = new UserList();
$response = $registration->get_users();
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
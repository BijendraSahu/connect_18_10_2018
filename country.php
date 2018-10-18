<?php
require_once("model/Country.php");
if (isset($_GET['id']))
    $ID = $_GET["id"];

if ($_GET['service'] == 'get_country') {
    $registration = new Country();
    $response = $registration->get_country();
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
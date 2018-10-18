<?php
require_once("model/GetPost.php");
//if (isset($_GET['user_id']))
$user_id = $_GET["user_id"];

if ($_GET['service'] == 'get') {
    $post = new GetPost();
    $response = $post->get_post($user_id);
//    $ret['response'] = $post->get_post($user_id);
//    echo json_encode($ret);
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
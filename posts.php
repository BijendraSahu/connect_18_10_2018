<?php
require_once("model/Posts.php");
if (isset($_GET['user_id']))
    $user_id = $_GET["user_id"];

if ($_GET['service'] == 'insert_like') {
    $posts = new Posts();
    $posts->post_id = $_GET['post_id'];
    $posts->user_id = $_GET['user_id'];
    $ret['response'] = $posts->insert_like();
    print json_encode($ret);
} elseif ($_GET['service'] == 'insert_comment') {
    $posts = new Posts();
    $posts->post_id = $_GET['post_id'];
    $posts->user_id = $_GET['user_id'];
    $des = json_decode($_GET['description']);
    $posts->description = $des->comment;
    $ret['response'] = $posts->insert_comments();
    print json_encode($ret);
} else {
    $ret['response'] = 0;
    echo json_encode($ret);
}
?>
<?php
require_once("model/BusinessType.php");
if (isset($_GET['ID']))
    $ID = $_GET["ID"];

if ($_GET['service'] == 'insert') {
    $business_type_obj = new BusinessType();
    $business_type_obj->BusinessTypeName = $_GET['BusinessTypeName'];
    $ret['response'] = $business_type_obj->insert_business_type();
    echo json_encode($ret);
} elseif ($_GET['service'] == 'get_all_business_type') {
    $business_type_obj = new BusinessType();
    $response = $business_type_obj->get_all_business_type();
    if ($response->count() > 0) {
        $arr = [];
        foreach ($response as $data) {
            $arr[] = $data;
        }
        $ret['response'] = $arr;
        echo json_encode($ret);
    }
} elseif ($_GET['service'] == 'get_business_type') {
    $business_type_obj = new BusinessType();
    $response = $business_type_obj->get_business_type($ID);
    if ($response->count() > 0) {
        $arr = [];
        foreach ($response as $data) {
            $arr[] = $data;
        }
        $ret['response'] = $arr;
        echo json_encode($ret);
    }
} elseif ($_GET['service'] == 'update_business_type') {
    $business_type_obj = new BusinessType();
    $ret['response'] = $business_type_obj->update_business_type();
    echo json_encode($ret);
} elseif ($_GET['service'] == 'active_business_type') {
    $business_type_obj = new BusinessType();
    $ret['response'] = $business_type_obj->active_business_type();
    echo json_encode($ret);
} elseif ($_GET['service'] == 'delete_business_type') {
    $business_type_obj = new BusinessType();
    $ret['response'] = $business_type_obj->delete_business_type();
    echo json_encode($ret);
} else {
    $ret['response'] = 0;
    echo json_encode($ret);
}
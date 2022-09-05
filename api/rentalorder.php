<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once('../includes/crud.php');

$db = new Database();
$db->connect();

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['rental_vehicle_id'])) {
    $response['success'] = false;
    $response['message'] = "rental vehicle id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['bike_name'])) {
    $response['success'] = false;
    $response['message'] = "Bike Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['price'])) {
    $response['success'] = false;
    $response['message'] = "Price is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['start_date'])) {
    $response['success'] = false;
    $response['message'] = "Start Date is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['end_date'])) {
    $response['success'] = false;
    $response['message'] = "End Date is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['start_time'])) {
    $response['success'] = false;
    $response['message'] = "Start Time is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['end_time'])) {
    $response['success'] = false;
    $response['message'] = "End Time is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$rental_vehicle_id = $db->escapeString($_POST['rental_vehicle_id']);
$bike_name = $db->escapeString($_POST['bike_name']);
$price = $db->escapeString($_POST['price']);
$start_date = $db->escapeString($_POST['start_date']);
$end_date = $db->escapeString($_POST['end_date']);
$start_time = $db->escapeString($_POST['start_time']);
$end_time = $db->escapeString($_POST['end_time']);

$sql = "INSERT INTO rental_orders (`user_id`,`rental_vehicle_id`,`bike_name`,`price`,`start_date`,`end_date`,`start_time`,`end_time`,`status`)VALUES('$user_id','$rental_vehicle_id','$bike_name','$price','$start_date','$end_date','$start_time','$end_time','2')";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Order Placed Successfully ";
print_r(json_encode($response));


?>
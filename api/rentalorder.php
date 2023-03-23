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
if (empty($_POST['type'])) {
    $response['success'] = false;
    $response['message'] = "Type is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobile Number is Empty";
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
if (empty($_POST['rental_vehicle_id'])) {
    $response['success'] = false;
    $response['message'] = "Rental vehicle id is Empty";
    print_r(json_encode($response));
    return false;
}

$user_id = $db->escapeString($_POST['user_id']);
$name = $db->escapeString($_POST['name']);
$mobile = $db->escapeString($_POST['mobile']);
$type = $db->escapeString($_POST['type']);
$start_time = $db->escapeString($_POST['start_time']);
$end_time = $db->escapeString($_POST['end_time']);
$rental_vehicle_id = $db->escapeString($_POST['rental_vehicle_id']);


$sql = "SELECT *,rv.id AS id,rc.hills_price,rc.normal_price,rv.rental_category_id FROM `rental_vehicles` rv,`rental_category` rc WHERE rv.rental_category_id=rc.id AND rv.id='$rental_vehicle_id'";
$db->sql($sql);
$res = $db->getResult();
$hills_price=$res[0]['hills_price'];
$normal_price=$res[0]['normal_price'];

$start_date = new DateTime($start_time);
$end_date = new DateTime($end_time);
$interval = $start_date->diff($end_date);
$days = $interval->days;


if ($type == 'hills_ride') {
    $price = $hills_price * $days;
} else {
    $price = $normal_price * $days;
}
$code = mt_rand(100000, 999999);

$sql = "INSERT INTO rental_orders (`user_id`,`name`,`mobile`,`rental_vehicles_id`,`start_time`,`end_time`,`price`,`otp`,`status`)VALUES('$user_id','$name','$mobile','$rental_vehicle_id','$start_time','$end_time','$price','$code',0)";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Rental Bike Booked Successfully ";
print_r(json_encode($response));


?>
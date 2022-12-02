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

if (empty($_POST['bike_name'])) {
    $response['success'] = false;
    $response['message'] = "Bike Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['date'])) {
    $response['success'] = false;
    $response['message'] = "Date is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['time'])) {
    $response['success'] = false;
    $response['message'] = "Time is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['type'])) {
    $response['success'] = false;
    $response['message'] = "Service Type is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['price'])) {
    $response['success'] = false;
    $response['message'] = "Price is Empty";
    print_r(json_encode($response));
    return false;
}

$bike_name = $db->escapeString($_POST['bike_name']);
$date = $db->escapeString($_POST['date']);
$time = $db->escapeString($_POST['time']);
$type = $db->escapeString($_POST['type']);
$price = $db->escapeString($_POST['price']);

$sql = "INSERT INTO booked_services (`bike_name`,`date`,`type`,`time`,`price`,status) VALUES ('$bike_name','$date','$type','$time','$price',0)";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Service Booked Successfully";
print_r(json_encode($response));

?>
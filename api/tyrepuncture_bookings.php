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
if (empty($_POST['tyre_type'])) {
    $response['success'] = false;
    $response['message'] = "Tyre Type is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['wheel'])) {
    $response['success'] = false;
    $response['message'] = "Wheel is Empty";
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
$tyre_type = $db->escapeString($_POST['tyre_type']);
$wheel = $db->escapeString($_POST['wheel']);
$price = $db->escapeString($_POST['price']);

$sql = "INSERT INTO  `tyrepuncture_bookings` (`bike_name`,`tyre_type`,`wheel`,`price`) VALUES ('$bike_name','$tyre_type','$wheel','$price')";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Tyre Puncture Service Booked Successfully";
print_r(json_encode($response));



?>
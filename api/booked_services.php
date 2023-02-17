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

$user_id = $db->escapeString($_POST['user_id']);
$bike_name = $db->escapeString($_POST['bike_name']);
$date = $db->escapeString($_POST['date']);
$time = $db->escapeString($_POST['time']);
$type = $db->escapeString($_POST['type']);
$complaint = $db->escapeString($_POST['complaint']);

$sql="SELECT * FROM bike_services,bikes WHERE bike_name = '$bike_name' AND type = '$type' AND bike_services.bike_id=bikes.id";
$db->sql($sql);
$res = $db->getResult();
$num=$db->numRows($res);
if($db->numRows($res) > 0){
    $price = $res[0]['price'];
}else{
    $price = "";
}
if(isset($_POST['type'])=='General'){
    $sql = "INSERT INTO booked_services (`user_id`,`bike_name`,`date`,`type`,`time`,`complaint`,`price`,status) VALUES ('$user_id','$bike_name','$date','$type','$time','$complaint','$price',0)";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Service Booked Successfully";
    print_r(json_encode($response));
}
else{
    // $sql = "INSERT INTO booked_services (`bike_name`,`date`,`type`,`time`,`complaint`,status) VALUES ('$bike_name','$date','$type','$time','$complaint',0)";
    // $db->sql($sql);
    // $res = $db->getResult();
    $response['success'] = false;
    $response['message'] = "Emergency Services is not available";
    print_r(json_encode($response));
}

?>
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
if (empty($_POST['type'])) {
    $response['success'] = false;
    $response['message'] = "Service Type is Empty";
    print_r(json_encode($response));
    return false;
}

$bike_name = $db->escapeString($_POST['bike_name']);
$type = $db->escapeString($_POST['type']);

$sql = "SELECT * FROM bikes,bike_services WHERE bike_name='$bike_name' AND type='$type' AND bike_services.bike_id=bikes.id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){
    $response['success'] = true;
    $response['message'] = "Price Fetched Successfully";
    $response['Price'] = $res[0]['price'];
    print_r(json_encode($response));
 }

else {
    $response['success'] = false;
    $response['message'] = "Not Found";
    print_r(json_encode($response));

}
?>
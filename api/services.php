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

if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['model'])) {
    $response['success'] = false;
    $response['message'] = "Model is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobile Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['service_type'])) {
    $response['success'] = false;
    $response['message'] = "Service type is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['category'])) {
    $response['success'] = false;
    $response['message'] = "Category is Empty";
    print_r(json_encode($response));
    return false;
}

$name = $db->escapeString($_POST['name']);
$model = $db->escapeString($_POST['model']);
$mobile = $db->escapeString($_POST['mobile']);
$service_type = $db->escapeString($_POST['service_type']);
$category = $db->escapeString($_POST['category']);

   

$sql = "INSERT INTO services (`name`,`model`,`mobile`,`service_type`,`category`) VALUES ('$name','$model','$mobile','$service_type','$category')";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = " Successfully Booked ";
$response['data'] = $res;
print_r(json_encode($response));


?>
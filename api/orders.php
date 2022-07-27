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
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "mobile is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['address'])) {
    $response['success'] = false;
    $response['message'] = "Address is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['pincode'])) {
    $response['success'] = false;
    $response['message'] = "Pincode is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['product_id'])) {
    $response['success'] = false;
    $response['message'] = "Product Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['product_variant_id'])) {
    $response['success'] = false;
    $response['message'] = "Product Variant Id is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$mobile = $db->escapeString($_POST['mobile']);
$name = $db->escapeString($_POST['name']);
$address = $db->escapeString($_POST['address']);
$pincode = $db->escapeString($_POST['pincode']);
$product_id = $db->escapeString($_POST['product_id']);
$product_variant_id = $db->escapeString($_POST['product_variant_id']);

   

$sql = "INSERT INTO orders (`user_id`,`mobile`,`name`,`address`,`pincode`,`product_id`,`product_variant_id`,`status`)VALUES('$user_id','$mobile','$name','$address','$pincode','$product_id','$product_variant_id',1)";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Order Placed Successfully ";
$response['data'] = $res;
print_r(json_encode($response));







?>
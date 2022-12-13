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

include_once('../includes/custom-functions.php');
include_once('../includes/functions.php');
$fn = new custom_functions;

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['product_id'])) {
    $response['success'] = false;
    $response['message'] = "Product Id is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['ratings'])) {
    $response['success'] = false;
    $response['message'] = "Ratings is Empty";
    print_r(json_encode($response));
    return false;
}


$user_id = $db->escapeString($_POST['user_id']);
$product_id = $db->escapeString($_POST['product_id']);
$ratings = $db->escapeString($_POST['ratings']);




$sql = "INSERT INTO ratings (`user_id`,`product_id`,`ratings`) VALUES ('$user_id','$product_id','$ratings')";
$db->sql($sql);
$sql = "SELECT AVG(ratings) AS avg_ratings FROM `ratings` WHERE product_id=$product_id";
$db->sql($sql);
$res = $db->getResult();
$product_ratings=$res[0]['avg_ratings'];
$sql = "UPDATE products SET ratings='$product_ratings' WHERE id=$product_id";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Ratings Added Successfully";
print_r(json_encode($response));



?>
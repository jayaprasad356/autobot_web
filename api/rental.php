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


if (empty($_POST['vehicle_group'])) {
    $response['success'] = false;
    $response['message'] = "Vehicle Group is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['model'])) {
    $response['success'] = false;
    $response['message'] = "Model is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['year_of_manufacture'])) {
    $response['success'] = false;
    $response['message'] = "Manufactured Year is Empty";
    print_r(json_encode($response));
    return false;
}

$vehicle_group = $db->escapeString($_POST['vehicle_group']);
$model = $db->escapeString($_POST['model']);
$year_of_manufacture = $db->escapeString($_POST['year_of_manufacture']);


   

$sql = "INSERT INTO rental (`vehicle_group`,`model`,`year_of_manufacture`) VALUES ('$vehicle_group','$model','$year_of_manufacture')";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = " Successfully Rented ";
$response['data'] = $res;
print_r(json_encode($response));


?>
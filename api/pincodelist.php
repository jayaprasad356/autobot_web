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

$search = (isset($_POST['search'])) ? $db->escapeString($_POST['search']) : "";
    
$sql = "SELECT * FROM `deliver_pincodes` WHERE pincode like '%" . $search . "%'";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "pincode listed Successfully";
$response['data'] = $res;
print_r(json_encode($response));

?>
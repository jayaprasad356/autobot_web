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

$hours = (isset($_POST['hours'])) ? $db->escapeString($_POST['hours']) : "0";
$pincode = (isset($_POST['pincode'])) ? $db->escapeString($_POST['pincode']) : "";   
$sql = "SELECT * FROM `rental_vehicles` WHERE pincode = '$pincode'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['category'] = $row['category'];
        $temp['brand'] = $row['brand'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['price_per_hour'] = $row['price_per_hour'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $temp['total_price'] = $hours * $row['price_per_hour'];
        $rows[] = $temp;
        
    }
    
    $response['success'] = true;
    $response['message'] = "Vehicles listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
    

}else{
    $response['success'] = false;
    $response['message'] = "No Vehicles Found";
    print_r(json_encode($response));

}

?>
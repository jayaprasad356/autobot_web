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

$sql = "SELECT * FROM `used_vehicles`,`seller` WHERE used_vehicles.seller_id = seller.id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['mobile'] = $row['mobile'];
        $temp['brand'] = $row['brand'];
        $temp['category'] = $row['category'];
        $temp['model'] = $row['model'];
        $temp['vehicle_no'] = $row['vehicle_no'];
        $temp['km_driven'] = $row['km_driven'];
        $temp['insurance'] = $row['insurance'];
        $temp['price'] = $row['price'];
        $temp['location'] = $row['location'];
        $temp['color'] = $row['color'];
        $temp['year'] = $row['year'];
        $temp['fuel'] = $row['fuel'];
        $temp['owner'] = $row['owner'];
        $temp['image'] = DOMAIN_URL . $row['image'];
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
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

$sql = "SELECT * FROM `bike_product_size` bs,`bikes` b WHERE bs.bike_id=b.id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['brand'] =$row['brand'];
        $temp['service_type'] = $row['type'];
        $temp['size'] = $row['size'];
        $temp['wheel'] = $row['wheel'];
        $temp['tyre_type'] = $row['tyre_type'];
        $temp['status'] = $row['status'];
        $rows[] = $temp;
        
    }

    $response['success'] = true;
    $response['message'] = "Bike Product Sizes listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Bike Product Sizes Found";
    print_r(json_encode($response));

}

?>
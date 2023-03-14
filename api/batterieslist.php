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

$bike_name = isset($_POST['bike_name']) && !empty($_POST['bike_name']) ? $db->escapeString($_POST['bike_name']) : "";
$type = isset($_POST['type']) && !empty($_POST['type']) ? $db->escapeString($_POST['type']) : "";
$size = isset($_POST['size']) && !empty($_POST['size']) ? $db->escapeString($_POST['size']) : "";


if (!empty($type) && !empty($bike_name) ) {
    $sql = "SELECT * FROM `batteries` WHERE type='$type' AND bike_name='$bike_name' AND status=1";
}
elseif (!empty($bike_name)) {
    $sql = "SELECT * FROM `batteries` WHERE `bike_name` LIKE '%$bike_name%' AND status=1";
}
 elseif (!empty($size)) {
    $sql = "SELECT * FROM `batteries` WHERE size='$size'  AND status=1";
} else {
    $sql = "SELECT * FROM `batteries` WHERE status=1";
}
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
            $temp['id'] = $row['id'];
            $temp['bike_name'] = $row['bike_name'];
            $temp['brand'] = $row['brand'];
            $temp['size'] = $row['size'];
            $temp['warranty'] =$row['warranty'];
            $temp['mrp'] =$row['amount'];
            $temp['delivery_charges'] = $row['delivery_charges'];
            $temp['fitting_charges'] = $row['fitting_charges'];
            $temp['actual_price'] = $row['actual_price'];
            $temp['price'] = $row['final_price'];
            $temp['image'] = DOMAIN_URL . $row['image'];
            if($row['status']==1){
                $temp['stock'] ='Available';
            }
            else{
                $temp['stock'] ='Not-Available';
            }
            $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Batteries listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Batteries  Found";
    print_r(json_encode($response));

}

?>
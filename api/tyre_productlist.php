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

$tyre_type = $db->escapeString($_POST['tyre_type']);
$wheel = $db->escapeString($_POST['wheel']);

$sql = "SELECT * FROM `tyre_products` WHERE tyre_type='$tyre_type' AND wheel='$wheel'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['brand'] = $row['brand'];
        $temp['size'] =$row['size'];
        $temp['wheel_type'] = $row['wheel'];
        $temp['pattern'] =$row['pattern'];
        $temp['tyre_type'] = $row['tyre_type'];
        $temp['amount'] =$row['amount'];
        $temp['delivery_charges'] = $row['delivery_charges'];
        $temp['fitting_charges'] = $row['fitting_charges'];
        $temp['actual_price'] = $row['actual_price'];
        $temp['final_price'] = $row['final_price'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $temp['status'] = $row['status'];
        if($row['status']==1){
            $temp['status'] ='Available';
        }
        else{
            $temp['status'] ='Not-Available';
        }
        $rows[] = $temp;
        
    }

    $response['success'] = true;
    $response['message'] = "Tyre Products listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Tyre Products Found";
    print_r(json_encode($response));

}

?>
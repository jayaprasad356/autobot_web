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

$sql = "SELECT * FROM `batteries` WHERE status=1";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        if($row['status']==1){
            $temp['id'] = $row['id'];
            $temp['brand'] = $row['brand'];
            $temp['warranty'] =$row['warranty'];
            $temp['amount'] =$row['amount'];
            $temp['delivery_charges'] = $row['delivery_charges'];
            $temp['fitting_charges'] = $row['fitting_charges'];
            $temp['actual_price'] = $row['actual_price'];
            $temp['final_price'] = $row['final_price'];
            $temp['stock'] = $row['status'];
            if($row['status']==1){
                $temp['stock'] ='Available';
            }
            else{
                $temp['stock'] ='Not-Available';
            }
            $rows[] = $temp;
        } 
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
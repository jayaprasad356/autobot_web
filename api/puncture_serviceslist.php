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

$sql = "SELECT * FROM `puncture_services` ps,`bikes` b WHERE ps.bike_id=b.id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['brand'] =$row['brand'];
        $temp['front_tubeless_price'] = $row['front_tube_less'];
        $temp['front_tube_tyre_price'] = $row['front_tube_tyre'];
        $temp['rear_tube_less_price'] = $row['rear_tube_less'];
        $temp['rear_tube_tyre_price'] = $row['rear_tube_tyre'];
        $temp['status'] = $row['status'];
        if($row['status']==1){
            $temp['status'] ='Booked';
        }
        elseif($row['status']==2){
            $temp['status'] ='Completed';
        }
        else{
            $temp['status'] ='Cancelled';
        }
        $rows[] = $temp;
        
    }

    $response['success'] = true;
    $response['message'] = "Puncture Services listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Puncture Services Found";
    print_r(json_encode($response));

}

?>
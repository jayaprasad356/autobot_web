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

if (empty($_POST['used_vehicle_id'])) {
    $response['success'] = false;
    $response['message'] = "Used Vehicle Id is Empty";
    print_r(json_encode($response));
    return false;
}

$used_vehicle_id = $db->escapeString($_POST['used_vehicle_id']);


$sql_query = "SELECT *  FROM used_vehicles WHERE id =" . $used_vehicle_id;
$db->sql($sql_query);
$res = $db->getResult();
$num = $db->numRows($res);
if($num==1){
    // $target_path =  DOMAIN_URL ."upload/vehicles/".$res[0]['image'];
	// 		if(unlink($target_path)){	
					$sql_query = "DELETE  FROM used_vehicles WHERE id =" . $used_vehicle_id;
					$db->sql($sql_query);
					$res = $db->getResult();
                    $response['success'] = true;
                    $response['message'] = "Vehicle Removed Successfully";
                    print_r(json_encode($response));
    // }
}
else{
    $response['success'] = false;
    $response['message'] ="Vehicle Not Found";
    print_r(json_encode($response));
    return false;
}

?>
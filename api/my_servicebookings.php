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
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}

$user_id = $db->escapeString($_POST['user_id']);

$sql = "SELECT * FROM `booked_services` WHERE user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['type'] = $row['type'];
        $temp['complaint'] = $row['complaint'];
        $temp['price'] = $row['price'];
        if($row['status'] == 0){
            $temp['status'] = "Pending";
        }else if($row['status'] == 1){
            $temp['status'] = "Confirmed";
        }else{
            $temp['status'] = "Completed";
        }
        $temp['date'] = $row['date'];
        $temp['time'] = $row['time'];
        $rows[] = $temp;
        
    }
    
    $response['success'] = true;
    $response['message'] = "My Service Bookings listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
    

}else{
    $response['success'] = false;
    $response['message'] = "You are not booked any service yet";
    print_r(json_encode($response));

}

?>
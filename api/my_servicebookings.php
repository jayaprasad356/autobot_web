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
        $temp['Bike Name'] = $row['bike_name'];
        $temp['Service_type'] = $row['type'];
        $temp['Complaint'] = $row['complaint'];
        $temp['Price'] = $row['price'];
        if($row['status'] == 0){
            $temp['Status'] = "Pending";
        }else if($row['status'] == 1){
            $temp['Status'] = "Confirmed";
        }else{
            $temp['Status'] = "Completed";
        }
        $temp['Date'] = $row['date'];
        $temp['Time'] = $row['time'];
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
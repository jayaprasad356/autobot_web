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
$sql = "SELECT *,ro.id AS id,rc.hills_price,rc.normal_price,rc.brand,rc.bike_name,rv.pincode,rv.image,ro.price,ro.start_time,ro.end_time,ro.name,ro.mobile,ro.status AS status,ro.rental_vehicles_id,rv.rental_category_id,ro.otp FROM `rental_orders` ro,`rental_vehicles` rv,`rental_category` rc WHERE rv.rental_category_id=rc.id AND ro.rental_vehicles_id=rv.id AND ro.user_id='$user_id' ORDER BY ro.id DESC";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['name'] = $row['name'];
        $temp['mobile'] = $row['mobile'];
        $temp['brand'] = $row['brand'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['hills_price'] = $row['hills_price'];
        $temp['normal_price'] = $row['normal_price'];
        $temp['pincode'] = $row['pincode'];
        $temp['start_time'] = $row['start_time'];
        $temp['end_time'] = $row['end_time'];
        $temp['otp'] = $row['otp'];
        $temp['price'] = $row['price'];
        $temp['status'] = $row['status'];
        $temp['image'] = DOMAIN_URL ."upload/rentals/" .$row['image'];
        $rows[] = $temp;
        
    }
    
    $response['success'] = true;
    $response['message'] = "Rental Bookings Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
    

}else{
    $response['success'] = false;
    $response['message'] = "You Have not booked yet";
    print_r(json_encode($response));

}



?>
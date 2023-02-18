<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('Asia/Kolkata');


include_once('../includes/crud.php');
$db = new Database();
$db->connect();

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['grand_total'])) {
    $response['success'] = false;
    $response['message'] = "Grand Total  is Empty";
    print_r(json_encode($response));
    return false;
}

$user_id = $db->escapeString($_POST['user_id']);
$grand_total = $db->escapeString($_POST['grand_total']);
$date = date('Y-m-d');
$sql = "SELECT *,battery_cart.id AS id  FROM battery_cart,batteries WHERE battery_cart.product_id=batteries.id AND battery_cart.user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if($num>=1){
    foreach ($res as $row) {
        $id = $row['id'];
        $product_id = $row['product_id'];
        $total = $row['final_price'];
        $quantity = $row['quantity'];

        $sql = "INSERT INTO battery_bookings (`user_id`,`product_id`,`quantity`,`price`,`grand_total`,`order_date`,`status`)VALUES('$user_id','$product_id','$quantity','$total','$grand_total','$date',1)";
        $db->sql($sql);
        $sql = "DELETE FROM battery_cart WHERE id = '$id'";
        $db->sql($sql);
        $response['success'] = true;
        $response['message'] = "Order Placed Successfully ";
        print_r(json_encode($response));

    }
}


?>
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

$sql = "SELECT * FROM users WHERE id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if($num==1){
    $response['success'] = true;
    $response['message'] = "Checkout Retrived Successfully";
    $response['name'] = $res[0]['name'];
    $response['mobile'] = $res[0]['mobile'];
    $response['address'] =$res[0]['address'].'-'.$res[0]['city'].'-'.$res[0]['pincode'];

    $sql = "SELECT *,battery_cart.id AS id,batteries.final_price * battery_cart.quantity AS price   FROM battery_cart,batteries WHERE battery_cart.product_id=batteries.id AND battery_cart.user_id='$user_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if($num>=1){
        $sum = 0;
        foreach ($res as $row) {
            $sum += $row['price'];
            $temp['id'] = $row['id'];
            $temp['price'] = $row['price'];
            $temp['brand'] = $row['brand'];
            $temp['type'] = $row['type'];
            $temp['warranty'] = $row['warranty'];
            $temp['delivery_charges'] = $row['delivery_charges'];
            $temp['fitting_charges'] = $row['fitting_charges'];
            $temp['image'] = DOMAIN_URL . $row['image'];
            $rows[] = $temp;
        }
        // $sql = "SELECT * FROM `delivery_charges`";
        // $db->sql($sql);
        // $res = $db->getResult();
        // $deliver_charges = $res[0]['delivery_charge'] * $num;
        $grand_total = $sum;
        $response['sub_total'] = $sum;
        // $response['delivery_charges'] = $deliver_charges;
        $response['cart_items'] = $rows;
        $response['grand_total'] = $grand_total;
        print_r(json_encode($response));
    }
}
else{
    $response['success'] = false;
    $response['message'] = "User Not Found";
    print_r(json_encode($response));
}


?>
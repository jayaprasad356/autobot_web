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
$sql = "SELECT *,battery_cart.id AS id,batteries.final_price * battery_cart.quantity AS price,batteries.amount,batteries.final_price AS product_price  FROM battery_cart,batteries WHERE battery_cart.product_id=batteries.id AND battery_cart.user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if($num>=1){
    $sum = 0;
    foreach ($res as $row) {
        $sum += $row['price'];
        $temp['id'] = $row['id'];
        $temp['brand'] = $row['brand'];
        $temp['type'] = $row['type'];
        $temp['warranty'] = $row['warranty'];
        $temp['mrp'] = $row['amount'];
        $temp['product_price'] = $row['product_price'];
        $temp['quantity'] = $row['quantity'];
        $temp['total'] = $row['price'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Batteries Cart listed Successfully";
    $response['total_items'] = $num;
    $response['total_price'] = $sum;
    $response['data'] = $rows;
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] = "Batteries Not Found in Batterycart";
    print_r(json_encode($response));
}


?>
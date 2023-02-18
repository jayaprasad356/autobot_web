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
$sql = "SELECT *,tyre_cart.id AS id,tyre_products.final_price * tyre_cart.quantity AS price,tyre_products.amount,tyre_products.final_price AS product_price  FROM tyre_cart,tyre_products WHERE tyre_cart.product_id=tyre_products.id AND tyre_cart.user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if($num>=1){
    $sum = 0;
    foreach ($res as $row) {
        $sum += $row['price'];
        $temp['id'] = $row['id'];
        $temp['brand'] = $row['brand'];
        $temp['size'] = $row['size'];
        $temp['wheel'] = $row['wheel'];
        $temp['tyre_type'] = $row['tyre_type'];
        $temp['pattern'] = $row['pattern'];
        $temp['mrp'] = $row['amount'];
        $temp['product_price'] = $row['product_price'];
        $temp['quantity'] = $row['quantity'];
        $temp['total'] = $row['price'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "TyreCart listed Successfully";
    $response['total_items'] = $num;
    $response['total_price'] = $sum;
    $response['data'] = $rows;
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] = "Products Not Found in TyreCart";
    print_r(json_encode($response));
}


?>
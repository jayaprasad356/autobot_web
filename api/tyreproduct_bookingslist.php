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
$sql = "SELECT * FROM tyreproduct_bookings WHERE user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){
    
        $sql = "SELECT *,tp.image AS image,tpb.price AS price,tpb.id AS id,tp.amount,tpb.order_date,u.name,u.mobile,u.address FROM `tyreproduct_bookings` tpb,`tyre_products` tp,`users` u WHERE tpb.product_id = tp.id AND tpb.user_id=u.id AND tpb.user_id='$user_id'";
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);
        
            foreach ($res as $row) {
                $temp['id'] = $row['id'];
                $temp['name'] = $row['name'];
                $temp['address'] = $row['address'];
                $temp['mobile'] = $row['mobile'];
                $temp['brand'] = $row['brand'];
                $temp['size'] = $row['size'];
                $temp['wheel'] = $row['wheel'];
                $temp['tyre_type'] = $row['tyre_type'];
                $temp['pattern'] = $row['pattern'];
                $temp['image'] = DOMAIN_URL . $row['image'];
                $temp['mrp'] = $row['amount'];
                $temp['price'] = $row['price'];
                $temp['quantity'] = $row['quantity'];
                $temp['grand_total'] = $row['grand_total'];
                $temp['order_date'] = $row['order_date'];
                $rows[] = $temp;
                
            }
        
            $response['success'] = true;
            $response['message'] = "Tyre Product Orders listed Successfully";
            $response['data'] = $rows;
            print_r(json_encode($response));
 }

else {
    $response['success'] = false;
    $response['message'] = "No Tyre Product Orders Found";
    print_r(json_encode($response));

}

?>
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
$sql = "SELECT * FROM battery_bookings WHERE user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){
    
        $sql = "SELECT *,b.image AS image,bb.price AS price,bb.id AS id,b.amount,bb.order_date,u.name,u.mobile,u.address FROM `battery_bookings` bb,`batteries` b,`users` u WHERE bb.product_id = b.id AND bb.user_id=u.id AND bb.user_id='$user_id'";
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);
        
            foreach ($res as $row) {
                $temp['id'] = $row['id'];
                $temp['name'] = $row['name'];
                $temp['address'] = $row['address'];
                $temp['mobile'] = $row['mobile'];
                $temp['brand'] = $row['brand'];
                $temp['type'] = $row['type'];
                $temp['warranty'] = $row['warranty'];
                $temp['image'] = DOMAIN_URL . $row['image'];
                $temp['mrp'] = $row['amount'];
                $temp['price'] = $row['price'];
                $temp['quantity'] = $row['quantity'];
                $temp['grand_total'] = $row['grand_total'];
                $temp['order_date'] = $row['order_date'];
                $rows[] = $temp;
                
            }
        
            $response['success'] = true;
            $response['message'] = "Battery Orders listed Successfully";
            $response['data'] = $rows;
            print_r(json_encode($response));
 }

else {
    $response['success'] = false;
    $response['message'] = "You have not placed any orders yet";
    print_r(json_encode($response));

}

?>
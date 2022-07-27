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
$sql = "SELECT * FROM orders WHERE user_id='$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){
    
        $sql = "SELECT *,products.image AS image FROM orders,products,product_variant WHERE orders.product_id = products.id AND orders.product_variant_id = product_variant.id AND orders.user_id='$user_id'";
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);
        
            foreach ($res as $row) {
                $temp['id'] = $row['id'];
                $temp['mobile'] = $row['mobile'];
                $temp['name'] =$row['name'];
                $temp['address'] = $row['address'];
                $temp['pincode'] = $row['pincode'];
                $temp['product_name'] = $row['product_name'];
                $temp['brand'] = $row['brand'];
                $temp['image'] = DOMAIN_URL . $row['image'];
                $temp['model'] = $row['model'];
                $temp['price'] = $row['price'];
                $rows[] = $temp;
                
            }
        
            $response['success'] = true;
            $response['message'] = "Orders listed Successfully";
            $response['data'] = $rows;
            print_r(json_encode($response));
 }

else {
    $response['success'] = false;
    $response['message'] = "No Orders Found";
    print_r(json_encode($response));

}

?>
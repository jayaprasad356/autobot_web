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


$sql = "SELECT p.*,c.name AS category_name,p.image AS image,p.id AS id FROM `products` p,`categories` c WHERE p.category_id=c.id AND c.name='others'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $data = array();
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['category_name'] = $row['category_name'];
        $temp['product_name'] = $row['product_name'];
        $temp['brand'] = $row['brand'];
        $temp['model'] = $row['model'];
        $temp['price'] = $row['price'];
        $temp['description'] = $row['description'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $rows[] = $temp;
        
    }

    $response['success'] = true;
    $response['message'] = "Products listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Products Found";
    print_r(json_encode($response));

}

?>
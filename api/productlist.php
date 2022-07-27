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
if (empty($_POST['category_id'])) {
    $response['success'] = false;
    $response['message'] = "Category Id is Empty";
    print_r(json_encode($response));
    return false;
}
$category_id = $db->escapeString($_POST['category_id']);

$sql = "SELECT *,categories.name AS category_name,products.image AS image,products.id AS id FROM `products`,`categories` WHERE products.category_id=categories.id  AND products.category_id = $category_id";
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
        $temp['description'] = $row['description'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $temp['product_variant'] = array();

        $sql="SELECT * FROM product_variant WHERE product_id='$row[id]'";
        $db->sql($sql);
        $res = $db->getResult();
        $temp['product_variant'] = $res;
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
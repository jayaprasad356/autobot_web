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


if(empty($_POST['user_id'])){
    $sql = "SELECT *,used_vehicles.id AS id FROM `used_vehicles`,`users` WHERE used_vehicles.status=1 AND used_vehicles.user_id = users.id";
}
else{
    $user_id = $db->escapeString($_POST['user_id']);
    $sql = "SELECT *,used_vehicles.id AS id FROM `used_vehicles`,`users` WHERE used_vehicles.user_id = users.id AND used_vehicles.status=1 AND  used_vehicles.user_id = $user_id ";
}

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
        $temp['model'] = $row['model'];
        $temp['km_driven'] = $row['km_driven'];
        $temp['price'] = $row['price'];
        $temp['location'] = $row['location'];
        $temp['color'] = $row['color'];
        $temp['bike_image'] = DOMAIN_URL ."upload/vehicles/".$row['image'];
        $temp['image1'] = DOMAIN_URL ."upload/vehicles/".$row['image1'];
        $temp['image2'] = DOMAIN_URL ."upload/vehicles/".$row['image2'];
        $temp['image3'] = DOMAIN_URL ."upload/vehicles/".$row['image3'];
        $rows[] = $temp;
        
    }
    
    $response['success'] = true;
    $response['message'] = "Vehicles listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
    

}else{
    $response['success'] = false;
    $response['message'] = "No Vehicles Found";
    print_r(json_encode($response));

}

?>
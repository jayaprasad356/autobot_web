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
  
$sql = "SELECT rv.id AS id, rc.brand, rc.bike_name, rc.cc, rc.hills_price, rc.normal_price, rv.pincode, 
       COALESCE(ro.status, 2) AS available_status, rv.image
FROM `rental_vehicles` rv
LEFT JOIN (
    SELECT rental_vehicles_id, MAX(end_time) AS end_time
    FROM `rental_orders`
    GROUP BY rental_vehicles_id
) ro_max ON rv.id = ro_max.rental_vehicles_id
LEFT JOIN `rental_orders` ro ON ro_max.rental_vehicles_id = ro.rental_vehicles_id AND ro_max.end_time = ro.end_time
INNER JOIN `rental_category` rc ON rv.rental_category_id = rc.id 
WHERE (ro.id IS NULL OR ro.status = 2) ORDER BY available_status DESC
";

$db->sql($sql); 
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['brand'] = $row['brand'];
        $temp['bike_name'] = $row['bike_name'];
        $temp['cc'] = $row['cc'];
        $temp['hills_price'] = $row['hills_price'];
        $temp['normal_price'] = $row['normal_price'];
        $temp['pincode'] = $row['pincode'];
        $temp['available_status'] = $row['available_status'];
        $temp['image'] = DOMAIN_URL ."upload/rentals/" .$row['image'];
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
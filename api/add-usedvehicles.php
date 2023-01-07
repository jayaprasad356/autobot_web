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

include_once('../includes/custom-functions.php');
include_once('../includes/functions.php');
$fn = new custom_functions;

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['brand'])) {
    $response['success'] = false;
    $response['message'] = "Brand is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['bike_name'])) {
    $response['success'] = false;
    $response['message'] = "Bike Name is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['model'])) {
    $response['success'] = false;
    $response['message'] = "Model is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['price'])) {
    $response['success'] = false;
    $response['message'] = "Price is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['location'])) {
    $response['success'] = false;
    $response['message'] = "Location is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['km_driven'])) {
    $response['success'] = false;
    $response['message'] = "Kilometer Driven is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['color'])) {
    $response['success'] = false;
    $response['message'] = "Color is Empty";
    print_r(json_encode($response));
    return false;
}


$user_id = $db->escapeString($_POST['user_id']);
$brand = $db->escapeString($_POST['brand']);
$bike_name = $db->escapeString($_POST['bike_name']);
$model = $db->escapeString($_POST['model']);
$km_driven = $db->escapeString($_POST['km_driven']);
$price = $db->escapeString($_POST['price']);
$location = $db->escapeString($_POST['location']);
$color = $db->escapeString($_POST['color']);

if (isset($_FILES['image']) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
    if (!is_dir('../upload/vehicles/')) {
        mkdir('../upload/vehicles/', 0777, true);
    }
    $image = $db->escapeString($fn->xss_clean($_FILES['image']['name']));
    $extension = pathinfo($_FILES["image"]["name"])['extension'];
    $result = $fn->validate_image($_FILES["image"]);
    if (!$result) {
        $response["success"]   = false;
        $response["message"] = "Image type must jpg, jpeg, gif, or png!";
        print_r(json_encode($response));
        return false;
    }
    $filename = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/vehicles/' . "" . $filename;
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
        $response["success"]   = false;
        $response["message"] = "Invalid directory to load image!";
        print_r(json_encode($response));
        return false;
    }

$sql = "INSERT INTO used_vehicles (`user_id`,`brand`,`bike_name`,`model`,`km_driven`,`price`,`location`,`image`,`color`) VALUES ('$user_id','$brand','$bike_name','$model','$km_driven','$price','$location','$filename','$color')";
$db->sql($sql);
$res = $db->getResult();
$response['success'] = true;
$response['message'] = "Your Vehicle Added Successfully";
print_r(json_encode($response));

}


?>
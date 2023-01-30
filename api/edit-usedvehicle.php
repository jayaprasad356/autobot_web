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

if (empty($_POST['used_vehicle_id'])) {
    $response['success'] = false;
    $response['message'] = "Used Vehicle Id is Empty";
    print_r(json_encode($response));
    return false;
}

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

if (empty($_POST['km_driven'])) {
    $response['success'] = false;
    $response['message'] = "Kilometer Driven is Empty";
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
if (empty($_POST['color'])) {
    $response['success'] = false;
    $response['message'] = "Color is Empty";
    print_r(json_encode($response));
    return false;
}
$used_vehicle_id = $db->escapeString($_POST['used_vehicle_id']);
$user_id = $db->escapeString($_POST['user_id']);
$brand = $db->escapeString($_POST['brand']);
$bike_name = $db->escapeString($_POST['bike_name']);
$model = $db->escapeString($_POST['model']);
$km_driven = $db->escapeString($_POST['km_driven']);
$price = $db->escapeString($_POST['price']);
$location = $db->escapeString($_POST['location']);
$color = $db->escapeString($_POST['color']);

$sql = "SELECT * FROM used_vehicles WHERE id=" . $used_vehicle_id;
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if($num>=1){
    if (isset($_FILES['image']) && $_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0) {
        //image isn't empty and update the image
        $old_image="../upload/vehicles/".$res[0]['image'];
        $extension = pathinfo($_FILES["image"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["image"]);
        $target_path = '../upload/vehicles/';
        
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_image)) {
            unlink($old_image);
        }
        $upload_image =$filename;
        $sql = "UPDATE used_vehicles SET `image`='" . $upload_image . "' WHERE `id`=" . $used_vehicle_id;
        $db->sql($sql);
    }
    if (isset($_FILES['image1']) && $_FILES['image1']['size'] != 0 && $_FILES['image1']['error'] == 0) {
        //image isn't empty and update the image
        $old_image1="../upload/vehicles/".$res[0]['image1'];
        $extension = pathinfo($_FILES["image1"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["image1"]);
        $target_path = '../upload/vehicles/';
        
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image1"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_image1)) {
            unlink($old_image1);
        }
        $upload_image1 =$filename;
        $sql = "UPDATE used_vehicles SET `image1`='" . $upload_image1 . "' WHERE `id`=" . $used_vehicle_id;
        $db->sql($sql);
    }
    if (isset($_FILES['image2']) && $_FILES['image2']['size'] != 0 && $_FILES['image2']['error'] == 0) {
        //image isn't empty and update the image
        $old_image2="../upload/vehicles/".$res[0]['image2'];
        $extension = pathinfo($_FILES["image2"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["image2"]);
        $target_path = '../upload/vehicles/';
        
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image2"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_image2)) {
            unlink($old_image2);
        }
        $upload_image2 =$filename;
        $sql = "UPDATE used_vehicles SET `image2`='" . $upload_image2 . "' WHERE `id`=" . $used_vehicle_id;
        $db->sql($sql);
    }
    if (isset($_FILES['image3']) && $_FILES['image3']['size'] != 0 && $_FILES['image3']['error'] == 0) {
        //image isn't empty and update the image
        $old_image3="../upload/vehicles/".$res[0]['image3'];
        $extension = pathinfo($_FILES["image3"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["image3"]);
        $target_path = '../upload/vehicles/';
        
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image3"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_image3)) {
            unlink($old_image3);
        }
        $upload_image3 =$filename;
        $sql = "UPDATE used_vehicles SET `image3`='" . $upload_image3 . "' WHERE `id`=" . $used_vehicle_id;
        $db->sql($sql);
    }

    $sql = "UPDATE used_vehicles SET `user_id`='$user_id',`brand`='$brand',`bike_name`='$bike_name',`model`='$model',`km_driven`='$km_driven',`price`='$price',`location`='$location',`color`='$color' WHERE id=" . $used_vehicle_id;
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Your Vehicle Details updated Successfully";
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] ="Vehicle Not Found";
    print_r(json_encode($response));
    return false;
}



?>
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once('../includes/crud.php');
include('../includes/custom-functions.php');
$fn = new custom_functions();
$db = new Database();
$db->connect();

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
$id = $db->escapeString($_POST['user_id']);
if (isset($_FILES['license']) && !empty($_FILES['license']) && $_FILES['license']['error'] == 0 && $_FILES['license']['size'] > 0) {
    if (!empty($res[0]['license'])) {
        $old_image = $res[0]['license'];
        if ($old_image != 'default_user_license.png' && !empty($old_image)) {
            unlink('../upload/license/' . $old_image);
        }
    }

    $license = $db->escapeString($fn->xss_clean($_FILES['license']['name']));
    $extension = pathinfo($_FILES["license"]["name"])['extension'];

    $filename = microtime(true) . '.' . strtolower($extension);
    $full_path = '../upload/license/' . "" . $filename;
    if (!move_uploaded_file($_FILES["license"]["tmp_name"], $full_path)) {
        $response["error"]   = true;
        $response["message"] = "Invalid directory to load license!";
        print_r(json_encode($response));
        return false;
    }
    $sql = "UPDATE users SET `license`='$filename',`licenseupload` = 1 WHERE `id`=" . $id;
    $db->sql($sql);
    $response['success'] = true;
    $response['message'] = "License Uploaded Successfully";
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] = "License Not Uploaded";
    print_r(json_encode($response));
}



?>
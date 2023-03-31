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
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT * FROM users WHERE id=" . $user_id;
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if($num>=1){

    if (isset($_FILES['image']) && $_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0) {
        //image isn't empty and update the image
        $old_image=$res[0]['image'];
        $extension = pathinfo($_FILES["image"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["image"]);
        $target_path = '../upload/profile/';
        
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_image)) {
            unlink("../".$old_image);
        }
        $upload_image = 'upload/profile/' . $filename;
        $sql = "UPDATE users SET `image`='$upload_image' WHERE `id`=" . $user_id;
        $db->sql($sql);
        $response['success'] = true;
        $response['message'] = "Profile Image Updated Successfully";
        print_r(json_encode($response));
    }
    
    else{
        $response['success'] = false;
        $response['message'] = "Profile Image Not Uploaded";
        print_r(json_encode($response));
    }

}
else{
    $response['success'] = false;
    $response['message'] = "User Not Found";
    print_r(json_encode($response));
}




?>
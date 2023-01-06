<?php
include_once('../../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
session_start();

include('../../includes/variables.php');
include_once('../../includes/custom-functions.php');

include_once('../../includes/functions.php');
$function = new functions;
$fn = new custom_functions;


if (isset($_POST['add_seller']) && $_POST['add_seller'] == 1) {
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));

    $store_name = $db->escapeString($fn->xss_clean($_POST['store_name']));
    $tax_name = $db->escapeString($fn->xss_clean($_POST['tax_name']));
    $tax_number = $db->escapeString($fn->xss_clean($_POST['tax_number']));
    $pan_number = $db->escapeString($fn->xss_clean($_POST['pan_number']));
    $commission = 0;
    $status = '2';

    $password = $db->escapeString($fn->xss_clean($_POST['password']));

    $password = md5($password);

    $sql = 'SELECT id FROM seller WHERE mobile=' . $mobile;
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }
    $target_path = '../../upload/seller/';
    if (!is_dir($target_path)) {
        mkdir($target_path, 0777, true);
    }
    if ($_FILES['store_logo']['error'] == 0 && $_FILES['store_logo']['size'] > 0) {

        $extension = pathinfo($_FILES["store_logo"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["store_logo"]);
        if (!$result) {
            echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["store_logo"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }
    // address_proof national_id_card
    if ($_FILES['national_id_card']['error'] == 0 && $_FILES['national_id_card']['size'] > 0) {

        $extension = pathinfo($_FILES["national_id_card"]["name"])['extension'];

        // $result = $fn->validate_image($_FILES["national_id_card"]);
        // if (!$result) {
        //     echo " <span class='label label-danger'>National id card image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $national_id_card = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $national_id_card;
        if (!move_uploaded_file($_FILES["national_id_card"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }
    if ($_FILES['address_proof']['error'] == 0 && $_FILES['address_proof']['size'] > 0) {

        $extension = pathinfo($_FILES["address_proof"]["name"])['extension'];

        // $result = $fn->validate_image($_FILES["address_proof"]);
        // if (!$result) {
        //     echo " <span class='label label-danger'>Address Proof card image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $address_proof = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $address_proof;
        if (!move_uploaded_file($_FILES["address_proof"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }
    $sql = "INSERT INTO `seller`(`name`, `store_name`, `email`, `mobile`, `password`, `logo`,`commission`,`status`,`national_identity_card`,`address_proof`,`pan_number`,`tax_name`,`tax_number`) VALUES ('$name','$store_name','$email', '$mobile', '$password','$filename', '$commission','$status','$national_id_card','$address_proof','$pan_number','$tax_name','$tax_number')";

    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Seller Added Successfully!</label>';

    }
    else{
        echo '<label class="alert alert-danger">Failed!</label>';

    }
}

if (isset($_POST['update_seller'])  && !empty($_POST['update_seller'])) {

  

    $id = $db->escapeString($fn->xss_clean($_POST['update_id']));
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $store_name = $db->escapeString($fn->xss_clean($_POST['store_name']));
    $slug = $function->slugify($db->escapeString($fn->xss_clean($_POST['store_name'])), 'seller');
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $tax_name = $db->escapeString($fn->xss_clean($_POST['tax_name']));
    $tax_number = $db->escapeString($fn->xss_clean($_POST['tax_number']));
    $pan_number = $db->escapeString($fn->xss_clean($_POST['pan_number']));

    $status = (isset($_POST['status']) && $_POST['status'] != "") ? $db->escapeString($fn->xss_clean($_POST['status'])) : "2";
    $store_url = (isset($_POST['store_url']) && $_POST['store_url'] != "") ? $db->escapeString($fn->xss_clean($_POST['store_url'])) : "";
    $store_description = (isset($_POST['hide_description']) && $_POST['hide_description'] != "") ? $db->escapeString($fn->xss_clean($_POST['hide_description'])) : "";
    if (strpos($name, "'") !== false) {
        $name = str_replace("'", "''", "$name");
        if (strpos($store_description, "'") !== false)
            $store_description = str_replace("'", "''", "$store_description");
    }
    $street = (isset($_POST['street']) && $_POST['street'] != "") ? $db->escapeString($fn->xss_clean($_POST['street'])) : "";
    $pincode_id = (isset($_POST['pincode_id']) && $_POST['pincode_id'] != "") ? $db->escapeString($fn->xss_clean($_POST['pincode_id'])) : "0";
    $city_id = (isset($_POST['city_id']) && $_POST['city_id'] != "") ? $db->escapeString($fn->xss_clean($_POST['city_id'])) : "0";
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($fn->xss_clean($_POST['state'])) : "";
    $account_number = (isset($_POST['account_number']) && $_POST['account_number'] != "") ? $db->escapeString($fn->xss_clean($_POST['account_number'])) : "";
    $bank_ifsc_code = (isset($_POST['ifsc_code']) && $_POST['ifsc_code'] != "") ? $db->escapeString($fn->xss_clean($_POST['ifsc_code'])) : "";
    $account_name = (isset($_POST['account_name']) && $_POST['account_name'] != "") ? $db->escapeString($fn->xss_clean($_POST['account_name'])) : "";
    $bank_name = (isset($_POST['bank_name']) && $_POST['bank_name'] != "") ? $db->escapeString($fn->xss_clean($_POST['bank_name'])) : "";
    $latitude = (isset($_POST['latitude']) && $_POST['latitude'] != "") ? $db->escapeString($fn->xss_clean($_POST['latitude'])) : "0";
    $longitude = (isset($_POST['longitude']) && $_POST['longitude'] != "") ? $db->escapeString($fn->xss_clean($_POST['longitude'])) : "0";


    $sql = "SELECT * from seller where id='$id'";
    $db->sql($sql);
    $res_id = $db->getResult();
    if (!empty($res_id) && ($res_id[0]['status'] == 2 || $res_id[0]['status'] == 7)) {
        $response['error'] = true;
        $response['message'] = "Seller can not update becasue you have not-approoved or removed.";
        print_r(json_encode($response));
        return false;
        exit();
    }
    if (isset($_POST['old_password']) && $_POST['old_password'] != '') {
        $old_password = $db->escapeString($fn->xss_clean($_POST['old_password']));
        $old_password = md5($old_password);
        $res = $fn->get_data($column = ['password'], "id=" . $id, 'seller');
        if ($res[0]['password'] != $old_password) {
            echo "<label class='alert alert-danger'>Old password does't match.</label>";
            return false;
        }
    }

    if ($_POST['password'] != '' && $_POST['old_password'] == '') {
        echo "<label class='alert alert-danger'>Please enter old password.</label>";
        return false;
    }
    $password = !empty($_POST['password']) ? $db->escapeString($fn->xss_clean($_POST['password'])) : '';
    $password = !empty($password) ? md5($password) : '';

    if ($_FILES['store_logo']['size'] != 0 && $_FILES['store_logo']['error'] == 0 && !empty($_FILES['store_logo'])) {
        //image isn't empty and update the image
        $old_logo = $db->escapeString($fn->xss_clean($_POST['old_logo']));
        $extension = pathinfo($_FILES["store_logo"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["store_logo"]);
        if (!$result) {
            echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $target_path = '../../upload/seller/';
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["store_logo"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_logo)) {
            unlink($target_path . $old_logo);
        }
        $sql = "UPDATE seller SET `logo`='" . $filename . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }
    if ($_FILES['national_id_card']['size'] != 0 && $_FILES['national_id_card']['error'] == 0 && !empty($_FILES['national_id_card'])) {
        //image isn't empty and update the image
        $old_national_identity_card = $db->escapeString($fn->xss_clean($_POST['old_national_identity_card']));
        $extension = pathinfo($_FILES["national_id_card"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["national_id_card"]);
        if (!$result) {
            echo " <span class='label label-danger'>National id card image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $target_path = '../../upload/seller/';
        $national_id_card = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $national_id_card;
        if (!move_uploaded_file($_FILES["national_id_card"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_national_identity_card)) {
            unlink($target_path . $old_national_identity_card);
        }
        $sql = "UPDATE seller SET `national_identity_card`='" . $national_id_card . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }
    if ($_FILES['address_proof']['size'] != 0 && $_FILES['address_proof']['error'] == 0 && !empty($_FILES['address_proof'])) {
        //image isn't empty and update the image
        $old_address_proof = $db->escapeString($fn->xss_clean($_POST['old_address_proof']));
        $extension = pathinfo($_FILES["address_proof"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["address_proof"]);
        if (!$result) {
            echo " <span class='label label-danger'>Address Proof card image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $target_path = '../../upload/seller/';
        $address_proof = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $address_proof;
        if (!move_uploaded_file($_FILES["address_proof"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_address_proof)) {
            unlink($target_path . $old_address_proof);
        }
        $sql = "UPDATE seller SET `address_proof`='" . $address_proof . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }

    if (!empty($password)) {
        $sql = "UPDATE `seller` SET `name`='$name',`latitude`='$latitude',`longitude`='$longitude',`city_id`='$city_id',`store_name`='$store_name',`slug`='$slug',`email`='$email',`mobile`='$mobile',`password`='$password',`store_url`='$store_url',`store_description`='$store_description',`street`='$street',`pincode_id`='$pincode_id',`state`='$state',`account_number`='$account_number',`bank_ifsc_code`='$bank_ifsc_code',`account_name`='$account_name',`bank_name`='$bank_name',`status`=$status,`pan_number`='$pan_number',`tax_name`='$tax_name',`tax_number`='$tax_number' WHERE id=" . $id;
    } else {
        $sql = "UPDATE `seller` SET `name`='$name',`latitude`='$latitude',`longitude`='$longitude',`city_id`='$city_id',`store_name`='$store_name',`slug`='$slug',`email`='$email',`mobile`='$mobile',`store_url`='$store_url',`store_description`='$store_description',`street`='$street',`pincode_id`='$pincode_id',`state`='$state',`account_number`='$account_number',`bank_ifsc_code`='$bank_ifsc_code',`account_name`='$account_name',`bank_name`='$bank_name',`status`=$status,`pan_number`='$pan_number',`tax_name`='$tax_name',`tax_number`='$tax_number' WHERE id=" . $id;
    }
    if ($db->sql($sql)) {
        echo "<label class='alert alert-success'>Information Updated Successfully.</label>";
    } else {
        echo "<label class='alert alert-danger'>Some Error Occurred! Please Try Again.</label>";
    }
}




///rental showrooms 
if (isset($_POST['add_rental_showroom']) && $_POST['add_rental_showroom'] == 1) {
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $location = $db->escapeString($fn->xss_clean($_POST['location']));

    $status = '2';

    $password = $db->escapeString($fn->xss_clean($_POST['password']));


    $sql = 'SELECT id FROM rental_showrooms WHERE mobile=' . $mobile;
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }

    $sql = "INSERT INTO `rental_showrooms`(`name`,`email`, `mobile`, `password`, `location`,`status`) VALUES ('$name','$email', '$mobile', '$password','$location', '$status')";

    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Rental Showroom Added Successfully!</label>';

    }
    else{
        echo '<label class="alert alert-danger">Failed!</label>';

    }
}
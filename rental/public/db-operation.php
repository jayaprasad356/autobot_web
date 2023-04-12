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

if (isset($_POST['update_rental'])  && !empty($_POST['update_rental'])) {

  

    $id = $db->escapeString($fn->xss_clean($_POST['update_id']));
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));  
    $location = (isset($_POST['location']) && $_POST['location'] != "") ? $db->escapeString($fn->xss_clean($_POST['location'])) : "";
    $address = $db->escapeString($fn->xss_clean($_POST['address']));
    $pincode = $db->escapeString($fn->xss_clean($_POST['pincode']));
    $bank_account_number = $db->escapeString($fn->xss_clean($_POST['bank_account_number']));
    $ifsc_code = $db->escapeString($fn->xss_clean($_POST['ifsc_code']));
    $bank_name = $db->escapeString($fn->xss_clean($_POST['bank_name']));
    $branch = $db->escapeString($fn->xss_clean($_POST['branch']));
    $sql = "SELECT * from rental_showrooms where id='$id'";
    $db->sql($sql);
    $res_id = $db->getResult();
    if (!empty($res_id) && ($res_id[0]['status'] == 0)) {
        $response['error'] = true;
        $response['message'] = "You can not update becasue you have not-approoved or removed.";
        print_r(json_encode($response));
        return false;
        exit();
    }
    if (isset($_POST['old_password']) && $_POST['old_password'] != '') {
        $old_password = $db->escapeString($fn->xss_clean($_POST['old_password']));
        // $old_password = md5($old_password);
        // $res = $fn->get_data($column = ['password'], "id=" . $id, 'rental_showrooms');
        if ($res_id[0]['password'] != $old_password) {
            echo "<label class='alert alert-danger'>Old password does't match.</label>";
            return false;
        }
    }

    if ($_POST['password'] != '' && $_POST['old_password'] == '') {
        echo "<label class='alert alert-danger'>Please enter old password.</label>";
        return false;
    }
    $password = !empty($_POST['password']) ? $db->escapeString($fn->xss_clean($_POST['password'])) : '';

    if (!empty($password)) {
        $sql = "UPDATE `rental_showrooms` SET `name`='$name',`location`='$location',`email`='$email',`mobile`='$mobile',`password`='$password',address='$address',pincode='$pincode',bank_account_number='$bank_account_number',ifsc_code='$ifsc_code',bank_name='$bank_name',branch='$branch' WHERE id=" . $id;
    } else {
        $sql = "UPDATE `rental_showrooms` SET `name`='$name',`email`='$email',`mobile`='$mobile',address='$address',pincode='$pincode',bank_account_number='$bank_account_number',ifsc_code='$ifsc_code',bank_name='$bank_name',branch='$branch',location='$location' WHERE id=" . $id;
    }
    if ($db->sql($sql)) {
        echo "<label class='alert alert-success'>Information Updated Successfully.</label>";
    } else {
        echo "<label class='alert alert-danger'>Some Error Occurred! Please Try Again.</label>";
    }
}


if (isset($_POST['add_rental_showroom']) && $_POST['add_rental_showroom'] == 1) {
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $location = $db->escapeString($fn->xss_clean($_POST['location']));
    $address = $db->escapeString($fn->xss_clean($_POST['address']));
    $pincode = $db->escapeString($fn->xss_clean($_POST['pincode']));
    $bank_account_number = $db->escapeString($fn->xss_clean($_POST['bank_account_number']));
    $ifsc_code = $db->escapeString($fn->xss_clean($_POST['ifsc_code']));
    $bank_name = $db->escapeString($fn->xss_clean($_POST['bank_name']));
    $branch = $db->escapeString($fn->xss_clean($_POST['branch']));
    $status = '0';
    $password = $db->escapeString($fn->xss_clean($_POST['password']));


    $sql = 'SELECT id FROM rental_showrooms WHERE mobile=' . $mobile;
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }

    $sql = "INSERT INTO `rental_showrooms`(`name`,`email`, `mobile`, `password`, `location`,`address`,`pincode`,`bank_account_number`,`ifsc_code`,`bank_name`,`branch`,`status`,`permission`) VALUES ('$name','$email', '$mobile', '$password','$location','$address','$pincode','$bank_account_number','$ifsc_code','$bank_name','$branch', '$status',0)";

    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Rental Showroom Added Successfully!</label>';

    }
    else{
        echo '<label class="alert alert-danger">Failed!</label>';

    }
}
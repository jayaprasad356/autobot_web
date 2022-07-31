<?php
session_start();
include_once('../../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
include_once('../../includes/functions.php');
$function = new functions; 
include_once('../../includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_POST['add_mechanic']) && $_POST['add_mechanic'] == 1) {
    
    
    $name = $db->escapeString($_POST['name']);
    $mobile = $db->escapeString($_POST['mobile']);
    $password = $db->escapeString($_POST['password']);
    $address = (isset($_POST['address']) && $_POST['address'] != "") ? $db->escapeString($_POST['address']) : "";
    $district = (isset($_POST['district']) && $_POST['district'] != "") ? $db->escapeString($_POST['district']) : "";
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($_POST['state']) : "";
    $pincode = (isset($_POST['pincode']) && $_POST['pincode'] != "") ? $db->escapeString($_POST['pincode']) : "";

    
    $sql = "SELECT id FROM mechanic WHERE mobile='$mobile'";
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }

    $sql = "INSERT INTO `mechanic`(`name`, `mobile`,`password`, `address`, `district`, `state`, `pincode`) VALUES ('$name','$mobile','$password', '$address', '$district','$state' ,'$pincode')";
    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Mechanic Added Successfully!</label>';
    } else {
        echo '<label class="alert alert-danger">Some Error Occrred! please try again.</label>';
    }
}
if (isset($_POST['update_mechanic'])  && !empty($_POST['update_mechanic'])) {
    $id = $db->escapeString($_POST['update_id']);
    $name = $db->escapeString($_POST['name']);
    $mobile = $db->escapeString($_POST['mobile']);
    $address = $db->escapeString($_POST['address']);
    $district = (isset($_POST['district']) && $_POST['district'] != "") ? $db->escapeString($_POST['district']) : "";
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($_POST['state']) : "";
    $pincode = (isset($_POST['pincode']) && $_POST['pincode'] != "") ? $db->escapeString($_POST['pincode']) : "";
    

    $password = !empty($_POST['password']) ? $db->escapeString($_POST['password']) : '';

    $sql = "UPDATE `mechanic` SET `name`='$name',`mobile`='$mobile',`address`='$address',`district`='$district',`state`='$state',`pincode`='$pincode',`password`='$password' WHERE id='$id'";
    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Mechanic Updated Successfully!</label>';
    } else {
        echo '<label class="alert alert-danger">Some Error Occrred! please try again.</label>';
    }

}
?>
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

if (empty($_POST['showroom_name'])) {
    $response['success'] = false;
    $response['message'] = "Showroom Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobilenumber is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['brand'])) {
    $response['success'] = false;
    $response['message'] = "Brand is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['password'])) {
    $response['success'] = false;
    $response['message'] = "Password is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['working_hours'])) {
    $response['success'] = false;
    $response['message'] = "Working Hours is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['address'])) {
    $response['success'] = false;
    $response['message'] = "Address is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['pincode'])) {
    $response['success'] = false;
    $response['message'] = "Pincode is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['gst_tin'])) {
    $response['success'] = false;
    $response['message'] = "GST TIN is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['account_no'])) {
    $response['success'] = false;
    $response['message'] = "Account Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['ifsc_code'])) {
    $response['success'] = false;
    $response['message'] = "IFSC Code is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['alternate_mobile'])) {
    $response['success'] = false;
    $response['message'] = "Alternatre Mobile Number is Empty";
    print_r(json_encode($response));
    return false;
}
$showroom_name = $db->escapeString($_POST['showroom_name']);
$mobile = $db->escapeString($_POST['mobile']);
$brand = $db->escapeString($_POST['brand']);
$password = $db->escapeString($_POST['password']);
$working_hours = $db->escapeString($_POST['working_hours']);
$address = $db->escapeString($_POST['address']);
$pincode = $db->escapeString($_POST['pincode']);
$gst_tin = $db->escapeString($_POST['gst_tin']);
$account_no = $db->escapeString($_POST['account_no']);
$ifsc_code = $db->escapeString($_POST['ifsc_code']);
$alternate_mobile = $db->escapeString($_POST['alternate_mobile']);


$sql = "SELECT * FROM showroom WHERE mobile = '$mobile' AND password = '$password'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $response['success'] = false;
    $response['message'] ="Mobile Number Already Exists";
    print_r(json_encode($response));
    return false;
}
else{
    
    $sql = "INSERT INTO showroom (`showroom_name`,`mobile`,`password`,`brand`,`working_hours`,`address`,`pincode`,`gst_tin`,`account_no`,`ifsc_code`,`alternate_mobile`,status) VALUES ('$showroom_name','$mobile','$password','$brand','$working_hours','$address','$pincode','$gst_tin','$account_no','$ifsc_code','$alternate_mobile',0)";
    $db->sql($sql);
    $sql = "SELECT * FROM showroom WHERE mobile = '$mobile'";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Successfully Registered";
    $response['data'] = $res;

    print_r(json_encode($response));

}

?>
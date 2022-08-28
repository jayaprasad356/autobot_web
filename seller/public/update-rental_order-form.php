<?php
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['seller_id'];
}
$order_id = $_GET['id'];

if (isset($_POST['btnUpdate'])) {
    
    $seller_id = $ID;
    $status = $db->escapeString($_POST['status']);    

        $sql = "UPDATE rental_orders SET `status` = '$status' WHERE id = '" . $order_id . "'";
        $db->sql($sql);
        $order_result = $db->getResult();
        if (!empty($order_result)) {
            $order_result = 0;
        } else {
            $order_result = 1;
        }
        if ($order_result == 1 ) {
            $error['add_menu'] = "<section class='content-header'>
                                                <span id='success' class='label label-success'>Updated Successfully</span>
                                                
                                                 </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

}
$sql_query = "SELECT status FROM rental_orders WHERE id = '" . $order_id . "'";
$db->sql($sql_query);

$res = $db->getResult();

?>
<section class="content-header">
    <h1>Update Orders</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <h4><small><a  href='rental_orders.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Orders</a></small></h4>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Orders</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                
                    
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Status</label> <i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                                <select name="status" class="form-control" required>
                                <option value="0" <?php if ($res[0]['status'] == "0") {echo "selected";} ?>>Booked</option>
                                <option value="1" <?php if ($res[0]['status'] == "1") {echo "selected";} ?>>Confirmed</option>         
                                <option value="2" <?php if ($res[0]['status'] == "2") {echo "selected";} ?>>Completed</option>                                                                            
                                </select>
                            </div>
                       </div>
                    </div>
                    
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />
                        <!--<div  id="res"></div>-->
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>
<script>
    if ($("#success").text() == "Updated Successfully")
    {
        setTimeout(showpanel, 1000);
        
    }
    function showpanel() {     
        window.location.replace("rental_orders.php");
 }
</script>
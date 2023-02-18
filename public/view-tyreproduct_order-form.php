<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$order_id = $_GET['id'];
$sql = "SELECT *,tyreproduct_bookings.id AS id,tyreproduct_bookings.status AS status,users.name AS name,users.address AS address,users.pincode AS pincode,users.mobile AS mobile,tyreproduct_bookings.price AS price FROM `tyreproduct_bookings`,`tyre_products`,`users` WHERE tyreproduct_bookings.user_id=users.id AND tyreproduct_bookings.product_id=tyre_products.id  AND tyreproduct_bookings.id = '$order_id'";
$db->sql($sql);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>View Tyreproduct Orders</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
<div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Detail</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td><?php echo $res[0]['id'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td><?php echo $res[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mobile</th>
                                <td><?php echo $res[0]['mobile'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Address</th>
                                <td><?php echo $res[0]['address'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">PinCode</th>
                                <td><?php echo $res[0]['pincode'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Brand</th>
                                <td><?php echo $res[0]['brand'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Tyre Type</th>
                                <td><?php echo $res[0]['tyre_type'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Size</th>
                                <td><?php echo $res[0]['size'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Wheel</th>
                                <td><?php echo $res[0]['wheel'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Pattern</th>
                                <td><?php echo $res[0]['pattern'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Price</th>
                                <td><?php echo $res[0]['price'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Quantity</th>
                                <td><?php echo $res[0]['quantity'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Grand Total</th>
                                <td><?php echo $res[0]['grand_total'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Status</th>
                                <td>
                                    <?php 
                                    if($res[0]['status']==1){ ?>
                                    <p class="text text-info">Booked</p>
                                    <?php
                                    }
                                    else if($res[0]['status']==2){?>
                                    <p class="text text-success">Confirmed</p>
                                    <?php
                                    }
                                    else if($res[0]['status']==3){
                                        ?>
                                        <p class="text text-primary">Completed</p>
                                <?php
                                    }
                                    else{
                                        ?>
                                         <p class="text text-danger">Cancelled</p>
                                    <?php }
                                    ?>

                                </td>
                            </tr>
                        </table>
    
                    </div><!-- /.box-body -->
                    <?php
                    $order_id = $_GET['id'];

                    if (isset($_POST['btnUpdate'])) {
                        
                        $status = $db->escapeString($_POST['status']);    
                    
                            $sql = "UPDATE tyreproduct_bookings SET `status` = '$status' WHERE id = '" . $order_id . "'";
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
                    $sql_query = "SELECT status FROM tyreproduct_bookings WHERE id = '" . $order_id . "'";
                    $db->sql($sql_query);
                    
                    $res = $db->getResult();
                    
                    ?>
                    <section class="content-header">
                        <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
                    </section>
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group" >
                               <label class="control-label">Status</label> <i class="text-danger asterik">*</i><br>
                                <div id="status" class="btn-group">
                                    <label class="btn btn-warning" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Booked
                                    </label>
                                    <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="2" <?= ($res[0]['status'] == 2) ? 'checked' : ''; ?>> Confirmed
                                    </label>
                                    <label class="btn btn-primary" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="3" <?= ($res[0]['status'] == 3) ? 'checked' : ''; ?>> Completed
                                    </label>
                                    <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Cancelled
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />
                        <!--<div  id="res"></div>-->
                    </div>
                </form>
            </div><!--box--->

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
        window.location.replace("tyreproduct_orders.php");
    }
</script>

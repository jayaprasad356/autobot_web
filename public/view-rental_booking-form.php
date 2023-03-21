<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$order_id = $_GET['id'];
$sql = "SELECT ro.*,ro.id AS id,ro.status AS status,ro.name AS name,ro.mobile AS mobile,ro.start_time,ro.end_time,ro.commission_status,rv.pincode AS pincode,rc.brand,rc.bike_name,rc.hills_price,rc.normal_price,rc.commission,rv.rental_category_id,ro.rental_vehicles_id FROM `rental_orders` ro,`rental_vehicles` rv,`rental_category` rc WHERE ro.rental_vehicles_id=rv.id AND rv.rental_category_id=rc.id  AND ro.id = '$order_id'";
$db->sql($sql);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>View Rental Bookings</h1>
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
                        <h3 class="box-title">Booking Detail</h3>
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
                                <th style="width: 200px">PinCode</th>
                                <td><?php echo $res[0]['pincode'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Brand</th>
                                <td><?php echo $res[0]['brand'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Bike Name</th>
                                <td><?php echo $res[0]['bike_name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Hills Price</th>
                                <td><?php echo $res[0]['hills_price'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Normal Price</th>
                                <td><?php echo $res[0]['normal_price'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Commission</th>
                                <td><?php echo $res[0]['commission'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Status</th>
                                <td>
                                    <?php 
                                    if($res[0]['status']==0){ ?>
                                         <p class="text text-info">Booked</p>
                                    <?php
                                    }
                                    elseif($res[0]['status']==1){ ?>
                                          <p class="text text-success">Confirmed</p>
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <p class="text text-primary">Completed</p>
                                    <?php
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Commission Status</th>
                                <td>
                                    <?php 
                                    if($res[0]['commission_status']==0){ ?>
                                        <p class="text text-danger">Unpaid</p>
                                    <?php
                                    }
                                    else { ?>
                                        <p class="text text-success">Paid</p>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
    
                    </div><!-- /.box-body -->
                    <?php
                    $order_id = $_GET['id'];

                    if (isset($_POST['btnUpdate'])) {
                        
                        $commission_status = $db->escapeString($_POST['commission_status']);    
                    
                            $sql = "UPDATE rental_orders SET `commission_status` = '$commission_status' WHERE id = '" . $order_id . "'";
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
                    $sql_query = "SELECT commission_status FROM rental_orders WHERE id = '" . $order_id . "'";
                    $db->sql($sql_query);
                    
                    $res = $db->getResult();
                    
                    ?>
                    <section class="content-header">
                        <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
                    </section>
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group" >
                               <label class="control-label">Commission Status</label> <i class="text-danger asterik">*</i><br>
                                <div id="status" class="btn-group">
                                    <label class="btn btn-success" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="commission_status" value="1" <?= ($res[0]['commission_status'] == 1) ? 'checked' : ''; ?>> Paid
                                    </label>
                                    <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="commission_status" value="0" <?= ($res[0]['commission_status'] == 0) ? 'checked' : ''; ?>> Unpaid
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
        window.location.replace("rental_bookings.php");
    }
</script>

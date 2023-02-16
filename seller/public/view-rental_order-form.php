<?php
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$order_id = $_GET['id'];
$sql = "SELECT *,rental_orders.status AS status,rental_orders.id AS id FROM rental_orders,rental_vehicles,rental_category WHERE rental_orders.rental_vehicles_id=rental_vehicles.id AND rental_vehicles.rental_category_id=rental_category.id AND rental_orders.id = $order_id";
$db->sql($sql);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>View Order</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
<div class="row">
            <div class="col-md-6">
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
                                <th style="width: 200px"> Brand</th>
                                <td><?php echo $res[0]['brand'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Bike Name</th>
                                <td><?php echo $res[0]['bike_name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">CC</th>
                                <td><?php echo $res[0]['cc'] ?></td>
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
                                <th style="width: 200px">Pincode</th>
                                <td><?php echo $res[0]['pincode'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Start Time</th>
                                <td><?php echo $res[0]['start_time']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">End Time</th>
                                <td><?php echo $res[0]['end_time']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Status</th>
                                <td>
                                    <?php 
                                    if($res[0]['status']==0){ ?>
                                    <p class="text text-info">Booked</p>
                                    <?php
                                    }
                                    else if($res[0]['status']==1){?>
                                    <p class="text text-success">Confirmed</p>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <p class="text text-danger">Completed</p>
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
                        <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
                    </section>
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Status</label><i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                                <select name="status" class="form-control" required>
                                <option value="0"<?=$res[0]['status'] == '0' ? ' selected="selected"' : '';?>>Booked</option>
                                <option value="1"<?=$res[0]['status'] == '1' ? ' selected="selected"' : '';?>>Confirmed</option>
                                <option value="2"<?=$res[0]['status'] == '2' ? ' selected="selected"' : '';?>>Completed</option>                                                                          
                                </select>
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
        window.location.replace("rental_orders.php");
    }
</script>
<?php
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$order_id = $_GET['id'];
$sql = "SELECT *,used_vehicle_orders.status AS status,used_vehicle_orders.price AS price FROM used_vehicles,used_vehicle_orders,users WHERE used_vehicle_orders.used_vehicles_id=used_vehicles.id AND used_vehicle_orders.user_id=users.id AND used_vehicle_orders.id = $order_id";
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
                                <th style="width: 200px">Model</th>
                                <td><?php echo $res[0]['model'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Vehicle Number</th>
                                <td><?php echo $res[0]['vehicle_no'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">KM Driven</th>
                                <td><?php echo $res[0]['km_driven']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Insurance</th>
                                <td><?php echo $res[0]['insurance']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Price</th>
                                <td><?php echo $res[0]['price']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Description</th>
                                <td><?php echo $res[0]['description']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Location</th>
                                <td><?php echo $res[0]['location']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Color</th>
                                <td><?php echo $res[0]['color']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Owner</th>
                                <td><?php echo $res[0]['owner']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Fuel</th>
                                <td><?php echo $res[0]['fuel']; ?></td>
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
            </div><!--box--->

            </div>
        </div>
</section>
<div class="separator"> </div>

<?php
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$order_id = $_GET['id'];
$sql = "SELECT * FROM rental_vehicles,rental_orders WHERE rental_orders.rental_vehicles_id=rental_vehicles.id  AND rental_orders.id = $order_id";
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
                                <th style="width: 200px">Category</th>
                                <td><?php echo $res[0]['category'] ?></td>
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
                                <th style="width: 200px">Price/Km</th>
                                <td><?php echo $res[0]['km_charge'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Price/Minute</th>
                                <td><?php echo $res[0]['minute_charge'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Location</th>
                                <td><?php echo $res[0]['location']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Start Date</th>
                                <td><?php echo $res[0]['start_time']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">End Date</th>
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
                <div class="box-footer clearfix">
                        <?php
                        if($res [0]['status'] !='2'){?>
                            <a href="update-rental_orders.php?id=<?php echo $res[0]['id'] ?>"><button class="btn btn-primary">Update</button></a> 
                        <?php
                        }
                        ?>
                    
                        
                    
                </div>
            </div><!--box--->

            </div>
        </div>
</section>
<div class="separator"> </div>
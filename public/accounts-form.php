<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

$res = $db->getResult();
$id = $_SESSION['id'];

$sql = "SELECT * FROM users";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);


$sql = "SELECT * FROM bikes";
$db->sql($sql);
$result = $db->getResult();
$numa = $db->numRows($result);


$sql = "SELECT * FROM products";
$db->sql($sql);
$ress = $db->getResult();
$nums = $db->numRows($ress);


$sql = "SELECT * FROM services";
$db->sql($sql);
$services = $db->getResult();
$service = $db->numRows($services);


$sql = "SELECT * FROM battery_bookings";
$db->sql($sql);
$bookings = $db->getResult();
$booking = $db->numRows($bookings);



$sql = "SELECT SUM(price) AS total FROM orders";
$db->sql($sql);
$orders = $db->getResult();
$total = $orders[0]['total'];


$sql = "SELECT * FROM sellers";
$db->sql($sql);
$seller = $db->getResult();
$sellers = $db->numRows($seller);



$sql = "SELECT * FROM showrooms";
$db->sql($sql);
$showroom = $db->getResult();
$showrooms = $db->numRows($showroom);

?>
<section class="content-header">
    <h1>Accounts</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_opening_master_form'  method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                  <i class="fa fa-user"></i>  <label for="exampleInputEmail1">Total Users</label> 
                                    <input style="color:primary;font-weight:bold;" type="number" class="form-control"  value="<?php echo $num?>" readonly>
                                </div>
                                <div class='col-md-4'>
                                <i class="fa fa-cube"></i><label for="exampleInputEmail1"> Total Products</label>
                                    <input style="color:red;font-weight:bold;" type="number" class="form-control"  value="<?php echo $numa?>" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <i class="fa fa-motorcycle"></i><label for="exampleInputEmail1">Total Bikes</label> 
                                    <input type="number" style="color:violet;font-weight:bold;" class="form-control" value="<?php echo $nums?>" readonly>
                                </div>
                                <div class='col-md-4'>
                                    <i class="fa fa-wrench"></i><label for="exampleInputEmail1">Total Services</label> 
                                    <input type="number" style="color:green;font-weight:bold;" class="form-control"  value="<?php echo $service ?>" readonly>
                                    
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                  <i class="fa fa-battery-full"></i>  <label for="exampleInputEmail1">Total Battery Bookings</label> 
                                    <input style="color:blue;font-weight:bold;" type="number" class="form-control"  value="<?php echo $booking?>" readonly>
                                </div>
                                <div class='col-md-4'>
                                <i class="fa fa-shopping-cart"></i><label for="exampleInputEmail1"> Total Amount Received Through Orders <small>Rs</small></label>
                                    <input style="color:green;font-weight:bold;" type="number" class="form-control"  value="<?php echo $total?>" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                  <i class="fa fa-users"></i>  <label for="exampleInputEmail1">Total Sellers</label> 
                                    <input type="number" class="form-control"  value="<?php echo $sellers?>" readonly>
                                </div>
                                <div class='col-md-4'>
                                <i class="fa fa-home"></i><label for="exampleInputEmail1"> Total Showrooms</label>
                                    <input  type="number" class="form-control"  value="<?php echo $showrooms?>" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        <div class="box-footer">
                         </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_opening_master_form').validate({

        ignore: [],
        debug: false,
        rules: {
            ornament_stock: "required",
            pure: "required",
            digital_closing_stock: "required",
            cash_hand: "required",
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });

</script>

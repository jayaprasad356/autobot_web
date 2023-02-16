<?php
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

$seller_id = $_SESSION['seller_id'];

?>
<?php
if (isset($_POST['btnAdd'])) {


        $user_id = $db->escapeString($_POST['user_id']);
        $used_vehicles_id = $db->escapeString($_POST['used_vehicles_id']);
        $price = $db->escapeString($_POST['price']);
        $status = $db->escapeString($_POST['status']);
        $description = $db->escapeString($_POST['description']);
    

        if (empty($user_id)) {
            $error['user_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($used_vehicles_id)) {
            $error['used_vehicles_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($status)) {
            $error['status'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }
       


        if (!empty($user_id) && !empty($used_vehicles_id) && !empty($price) && !empty($description) && !empty($status)) {   
            $sql_query = "INSERT INTO used_vehicle_orders (user_id,used_vehicles_id,price,description,status) VALUES ('$user_id','$used_vehicles_id','$price','$description','$status')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_used_vehicle_order'] = " <section class='content-header'><span class='label label-success'>Used Vehicle Order Added Successfully</span></section>";
            } else {
                $error['add_used_vehicle_order'] = " <span class='label label-danger'>Failed!</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Used Vehicle Order <small><a href='used_vehicles_orders.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Used Vehicle Orders</a></small></h1>

    <?php echo isset($error['add_used_vehicle_order']) ? $error['add_used_vehicle_order'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-8">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="add_vehicle_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">User</label><i class="text-danger asterik">*</i>
                                        <select id='user_id' name="user_id" class='form-control' required>
                                                <option value="none">--Select--</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `users`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
                                                                <option value='<?= $value['id'] ?>'><?= $value['name'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Vehicle</label><i class="text-danger asterik">*</i>
                                        <select id='used_vehicles_id' name="used_vehicles_id" class='form-control' required>
                                                <option value="">--Select--</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `used_vehicles`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
                                                                <option value='<?= $value['id'] ?>'><?= $value['bike_name'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                    <input type="text" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label><i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                                    <select id="status" name="status" class="form-control">
                                        <option value="">--Select--</option>
                                        <option  value="1">Booked</option>
                                        <option value="2">Confirmed</option>
                                        <option value="3">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label><i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                            <textarea type="text" rows="3" class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                  
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" class="btn-warning btn" value="Clear" />
                    </div>
                </form>
                </div>
        </div>
    </div>
</section>

<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_vehicle_form').validate({

        ignore: [],
        debug: false,
        rules: {
            user_id: "required",
            status: "required",
            price:"required",
            description:"required",
            
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<?php $db->disconnect(); ?>
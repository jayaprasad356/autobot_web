<?php
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    // $ID = "";
    return false;
    exit(0);
}
if (isset($_POST['btnUpdate'])) {

        $user_id = $db->escapeString($_POST['user_id']);
        $used_vehicles_id = $db->escapeString($_POST['used_vehicles_id']);
        $price = $db->escapeString($_POST['price']);
        $description = $db->escapeString($_POST['description']);
        $status = $db->escapeString($_POST['status']);


        if (empty($user_id)) {
            $error['user_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($used_vehicles_id)) {
            $error['used_vehicles_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($status)) {
            $error['status'] = " <span class='label label-danger'>Required!</span>";
        }


        if ( !empty($user_id) && !empty($used_vehicles_id) && !empty($price) && !empty($description)) {
           
            $sql_query = "UPDATE used_vehicle_orders SET user_id='$user_id',used_vehicles_id='$used_vehicles_id',price='$price',description='$description',status='$status' WHERE id =  $ID";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['update_vehicle_order'] = " <section class='content-header'><span class='label label-success'>Vehicle Orders Updated Successfully</span></section>";
            } else {
                $error['update_vehicle_order'] = " <span class='label label-danger'>Failed!</span>";
            }
            }
        }
// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM used_vehicle_orders WHERE id =$ID";
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>Edit Used Vehicle Order<small><a href='used_vehicles_orders.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Used Vehicle Orders</a></small></h1>

    <?php echo isset($error['update_vehicle_order']) ? $error['update_vehicle_order'] : ''; ?>
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
                <form name="edit_vehicle_order_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">User</label><i class="text-danger asterik">*</i>
                                        <select id='user_id' name="user_id" class='form-control' required>
                                                <option value="">--Select--</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `users`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
															 <option value='<?= $value['id'] ?>' <?= $value['id']==$res[0]['user_id'] ? 'selected="selected"' : '';?>><?= $value['name'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Used Vehicles</label><i class="text-danger asterik">*</i><?php echo isset($error['used_vehicles_id']) ? $error['used_vehicles_id'] : ''; ?>
                                    <select id='used_vehicles_id' name="used_vehicles_id" class='form-control' required>
                                                <option value="">--Select--</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `used_vehicles`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
															 <option value='<?= $value['id'] ?>' <?= $value['id']==$res[0]['used_vehicles_id'] ? 'selected="selected"' : '';?>><?= $value['bike_name'] ?></option>
                                                            <?php } ?>
                                     </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                    <input type="number" class="form-control" name="price" value="<?php echo $res[0]['price']; ?>">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Status</label><i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                                    <select id="status" name="status" class="form-control">
                                        <option value="#">Select</option>
                                        <option value="0"<?=$res[0]['status'] == '0' ? ' selected="selected"' : '';?>>Booked</option>
                                        <option value="1"<?=$res[0]['status'] == '1' ? ' selected="selected"' : '';?>>Confirmed</option>
                                        <option value="2"<?=$res[0]['status'] == '2' ? ' selected="selected"' : '';?>>Completed</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class='col-md-6'>
                                    <label class="control-label">Status</label> <i class="text-danger asterik">*</i><br>
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-primary" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="0" <?= ($res[0]['status'] == "0") ? 'checked' : ''; ?>> Booked
                                        </label>
                                        <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="1" <?= ($res[0]['status'] == "1") ? 'checked' : ''; ?>> Confirmed
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="2" <?= ($res[0]['status'] == "2") ? 'checked' : ''; ?>> Completed
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Description</label><i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                            <textarea type="text" rows="3" class="form-control" name="description"><?php echo $res[0]['description']; ?></textarea>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
                    </div>

                </form>

            </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
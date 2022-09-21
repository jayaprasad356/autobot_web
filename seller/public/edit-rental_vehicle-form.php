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
$brand = '';
$bike_name = '';
$cc = '';
$hills_price = '';
$normal_price = '';
if (isset($_POST['btnView'])) {
    $rental_category_id = $db->escapeString($_POST['rental_category_id']);
    $sql="SELECT * FROM rental_category WHERE id = '$rental_category_id'";
    $db->sql($sql);
    $resslot = $db->getResult();
    $brand = $resslot[0]['brand'];
    $bike_name = $resslot[0]['bike_name'];
    $cc = $resslot[0]['cc'];
    $hills_price = $resslot[0]['hills_price'];
    $normal_price = $resslot[0]['normal_price'];


}
if (isset($_POST['btnUpdate'])) {


        $rental_category_id = $db->escapeString($_POST['rental_category_id']);
        $pincode = $db->escapeString($_POST['pincode']);
        $status=$db->escapeString($_POST['status']);

        

        if (empty($rental_category_id)) {
            $error['rental_category_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($pincode)) {
            $error['pincode'] = " <span class='label label-danger'>Required!</span>";
        }


        if (!empty($rental_category_id) && !empty($pincode)) {
           
            if ($_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0 && !empty($_FILES['image'])) {
				//image isn't empty and update the image
				$old_image = $db->escapeString($_POST['old_image']);
				$extension = pathinfo($_FILES["image"]["name"])['extension'];
		
				$result = $fn->validate_image($_FILES["image"]);
				$target_path = '../upload/rentals/';
				
				$filename = microtime(true) . '.' . strtolower($extension);
				$full_path = $target_path . "" . $filename;
				if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
					echo '<p class="alert alert-danger">Can not upload image.</p>';
					return false;
					exit();
				}
				if (!empty($old_image)) {
					unlink($old_image);
				}
				$upload_image = 'upload/rentals/' . $filename;
				$sql = "UPDATE rental_vehicles SET `image`='" . $upload_image . "' WHERE `id`=" . $ID;
				$db->sql($sql);
			}
           
            $sql_query = "UPDATE rental_vehicles SET rental_category_id='$rental_category_id',pincode='$pincode',image='$upload_image',status='$status' WHERE id =  $ID";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['update_vehicle'] = " <section class='content-header'><span class='label label-success'>Vehicle Updated Successfully</span></section>";
            } else {
                $error['update_vehicle'] = " <span class='label label-danger'>Failed!</span>";
            }
            }
        }
// create array variable to store previous data
$data = array();

$sql_query = "SELECT *,rental_vehicles.status AS status FROM rental_vehicles,rental_category  WHERE rental_vehicles.rental_category_id=rental_category.id AND rental_vehicles.id =$ID";
$db->sql($sql_query);
$res = $db->getResult();

?>
<section class="content-header">
    <h1>Edit Rental Vehicle <small><a href='rental_vehicles.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Vehicles</a></small></h1>

    <?php echo isset($error['update_vehicle']) ? $error['update_vehicle'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div><!-- /.box-header -->
                <form method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Bike Name</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_name']) ? $error['bike_name'] : ''; ?>
                                    <select id='rental_category_id' name="rental_category_id" class='form-control' required>
                                                <option value="">Select</option>
                                                            <?php
                                                            $sql = "SELECT id,bike_name FROM `rental_category`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
															 <option value='<?= $value['id'] ?>' <?= $value['bike_name']==$res[0]['bike_name'] ? 'selected="selected"' : '';?>><?= $value['bike_name'] ?></option>
                                                            <?php } ?>
                                        </select>                               
                               </div>
                            </div>
                            <div class="col-md-1">
                                  <button type="submit"  class="btn btn-primary" style="margin-top:24px;" name="btnView">View</button>                            
                            </div>
                        </div>

                    </div>
                </form>
                <!-- form start -->
                <form name="edit_vehicle_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                    <input type="hidden" class="form-control" name="rental_category_id"  value="<?php echo $rental_category_id ?>" readonly >
                      <input type="hidden" id="old_image" name="old_image"  value="<?= $res[0]['image']; ?>">
                         <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bike Name</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="bike_name"  value="<?php echo $bike_name ?>" readonly >
                                </div>
                            </div>
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="brand"  value="<?php echo $brand ?>" readonly >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CC</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="cc" value="<?php echo $cc ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hills Price</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="hills_price" value="<?php echo $hills_price ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Normal Price</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="normal_price" value="<?php echo $normal_price ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pincode</label><i class="text-danger asterik">*</i><?php echo isset($error['pincode']) ? $error['pincode'] : ''; ?>
                                    <input type="text" class="form-control" name="pincode" value="<?php echo $res[0]['pincode']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
									     <label for="exampleInputFile">Image</label><i class="text-danger asterik">*</i>
                                        <input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="image" id="image">
                                        <p class="help-block"><img id="blah" src="<?php echo "../".$res[0]['image']; ?>" style="max-width:100%" /></p>
                                </div>
                            </div>   
                          
                        </div>
                        <div class="row">
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Status</label><i class="text-danger asterik">*</i><br>
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-success" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Available
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Unavailable
                                        </label>
                                    </div>
                                </div>
                            </div>
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
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<?php $db->disconnect(); ?>
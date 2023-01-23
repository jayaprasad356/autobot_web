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

        $brand = $db->escapeString($_POST['brand']);
        $bike_name = $db->escapeString($_POST['bike_name']);
        $model = $db->escapeString($_POST['model']);
        $km_driven = $db->escapeString($_POST['km_driven']);
        $price = $db->escapeString($_POST['price']);
        $location = $db->escapeString($_POST['location']);
        $color = $db->escapeString($_POST['color']);
        $status = $db->escapeString($_POST['status']);


        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($bike_name)) {
            $error['bike_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($model)) {
            $error['model'] = " <span class='label label-danger'>Required!</span>";
        }
      
        if (empty($km_driven)) {
            $error['km_driven'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($color)) {
            $error['color'] = " <span class='label label-danger'>Required!</span>";
        }


        if ( !empty($brand) && !empty($bike_name) && !empty($model)  && !empty($km_driven) && !empty($price) && !empty($location) && !empty($color)) {
           
            if ($_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0 && !empty($_FILES['image'])) {
				//image isn't empty and update the image
				$old_image = $db->escapeString($_POST['old_image']);
				$extension = pathinfo($_FILES["image"]["name"])['extension'];
		
				$result = $fn->validate_image($_FILES["image"]);
				$target_path = '../upload/vehicles/';
				
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
				$upload_image = 'upload/vehicles/' . $filename;
				$sql = "UPDATE used_vehicles SET `image`='" . $upload_image . "' WHERE `id`=" . $ID;
				$db->sql($sql);
			}
           
            $sql_query = "UPDATE used_vehicles SET brand='$brand',bike_name='$bike_name',model='$model',km_driven='$km_driven',price='$price',location='$location',image='$upload_image',color='$color',status='$status' WHERE id =  $ID";
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

$sql_query = "SELECT * FROM used_vehicles WHERE id =$ID";
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>Edit Used Vehicle <small><a href='used_vehicles.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Vehicles</a></small></h1>

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
                <!-- form start -->
                <form name="edit_vehicle_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <input type="hidden" id="old_image" name="old_image"  value="<?= $res[0]['image']; ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i>
                                        <select id='brand' name="brand" class='form-control' required>
                                                <option value="none">Select</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `models`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
															 <option value='<?= $value['model'] ?>' <?= $value['model']==$res[0]['brand'] ? 'selected="selected"' : '';?>><?= $value['model'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Bike_name</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_name']) ? $error['bike_name'] : ''; ?>
                                    <input type="text" class="form-control" name="bike_name" value="<?php echo $res[0]['bike_name']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Model</label><i class="text-danger asterik">*</i><?php echo isset($error['model']) ? $error['model'] : ''; ?>
                                    <input type="number" class="form-control" name="model" value="<?php echo $res[0]['model']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> KM Driven</label><i class="text-danger asterik">*</i><?php echo isset($error['km_driven']) ? $error['km_driven'] : ''; ?>
                                    <input type="text" class="form-control" name="km_driven" value="<?php echo $res[0]['km_driven']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                    <input type="text" class="form-control" name="price" value="<?php echo $res[0]['price']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label><i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" value="<?php echo $res[0]['location']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Color</label><i class="text-danger asterik">*</i><?php echo isset($error['color']) ? $error['color'] : ''; ?>
                                    <input type="text" class="form-control" name="color" value="<?php echo $res[0]['color']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
									     <label for="exampleInputFile">Image</label><i class="text-danger asterik">*</i>
                                        <input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="image" id="image">
                                        <p class="help-block"><img id="blah" src="<?php echo $res[0]['image']; ?>" style="max-width:100%" /></p>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <label class="control-label">Stock</label> <i class="text-danger asterik">*</i><br>
                                <div id="status" class="btn-group">
                                    <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Not-Available
                                    </label>
                                    <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Available
                                    </label>
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
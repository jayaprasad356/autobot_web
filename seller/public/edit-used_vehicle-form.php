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
if (isset($_POST['btnEdit'])) {


        $vehicle_type = $db->escapeString($_POST['vehicle_type']);
        $brand = $db->escapeString($_POST['brand']);
        $category = $db->escapeString($_POST['category']);
        $model = $db->escapeString($_POST['model']);
        $vehicle_no = $db->escapeString($_POST['vehicle_no']);
        $km_driven = $db->escapeString($_POST['km_driven']);
        $type = $db->escapeString($_POST['type']);
        $insurance = $db->escapeString($_POST['insurance']);
        $price = $db->escapeString($_POST['price']);
        $location = $db->escapeString($_POST['location']);

        

        if (empty($vehicle_type)) {
            $error['vehicle_type'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($category)) {
            $error['category'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($model)) {
            $error['model'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($vehicle_no)) {
            $error['vehicle_no'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($km_driven)) {
            $error['km_driven'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($type)) {
            $error['type'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($insurance)) {
            $error['insurance'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }


        if (!empty($vehicle_type) && !empty($brand) && !empty($category) && !empty($model) && !empty($vehicle_no) && !empty($km_driven) && !empty($type) && !empty($insurance) && !empty($price) && !empty($location)   ) {
           
            if ($_FILES['bike_image']['size'] != 0 && $_FILES['bike_image']['error'] == 0 && !empty($_FILES['bike_image'])) {
				//image isn't empty and update the image
				$old_image = $db->escapeString($_POST['old_image']);
				$extension = pathinfo($_FILES["bike_image"]["name"])['extension'];
		
				$result = $fn->validate_image($_FILES["bike_image"]);
				$target_path = '../../upload/vehicles/';
				
				$filename = microtime(true) . '.' . strtolower($extension);
				$full_path = $target_path . "" . $filename;
				if (!move_uploaded_file($_FILES["bike_image"]["tmp_name"], $full_path)) {
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
           
            $sql_query = "UPDATE used_vehicles SET vehicle_type='$vehicle_type',brand='$brand',category='$category',model='$model',vehicle_no='$vehicle_no',km_driven='$km_driven',type='$type',insurance='$insurance',price='$price',location='$location',image='$upload_image' WHERE id =  $ID";
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
                    <h3 class="box-title">Edit Vehicle</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="edit_vehicle_form" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="old_image" name="old_image"  value="<?= $res[0]['image']; ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Vehicle Type</label><?php echo isset($error['vehicle_type']) ? $error['vehicle_type'] : ''; ?>
                                    <input type="text" class="form-control" name="vehicle_type" value="<?php echo $res[0]['vehicle_type']; ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                               <label  class="control-label"> Type</label>
                                <div class="form-group">
                                    <div id="type" class="btn-group">
                                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="type" value="New" <?= ($res[0]['type'] == 'New') ? 'checked' : ''; ?>>New
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="type" value="Used" <?= ($res[0]['type'] == 'Used') ? 'checked' : ''; ?>> Used
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Brand</label>
                                        <select id='brand' name="brand" class='form-control' required>
                                                <option value="none">Select</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `models`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
															 <option value='<?= $value['model'] ?>' <?= $value['id']==$res[0]['brand'] ? 'selected="selected"' : '';?>><?= $value['model'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Category</label><?php echo isset($error['category']) ? $error['category'] : ''; ?>
                                    <input type="text" class="form-control" name="category" value="<?php echo $res[0]['category']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Model</label><?php echo isset($error['model']) ? $error['model'] : ''; ?>
                                    <input type="number" class="form-control" name="model" value="<?php echo $res[0]['model']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Vehicle Number</label><?php echo isset($error['vehicle_no']) ? $error['vehicle_no'] : ''; ?>
                                    <input type="text" class="form-control" name="vehicle_no" value="<?php echo $res[0]['vehicle_no']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> KM Driven</label><?php echo isset($error['km_driven']) ? $error['km_driven'] : ''; ?>
                                    <input type="text" class="form-control" name="km_driven" value="<?php echo $res[0]['km_driven']; ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                               <label  class="control-label"> Insurance</label>
                                <div class="form-group" >
                                    <div id="insurance" class="btn-group">
                                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="insurance" value="Yes" <?= ($res[0]['insurance'] == 'Yes') ? 'checked' : ''; ?>>Yes
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="insurance" value="No"  <?= ($res[0]['type'] == 'No') ? 'checked' : ''; ?>> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Price</label><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                    <input type="text" class="form-control" name="price" value="<?php echo $res[0]['price']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" value="<?php echo $res[0]['location']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
									     <label for="exampleInputFile">Image</label>
                                        
                                        <input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="image" id="image">
                                        <p class="help-block"><img id="blah" src="<?php echo $res[0]['image']; ?>" style="max-width:100%" /></p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_vehicle_form').validate({

        ignore: [],
        debug: false,
        rules: {
            vehicle_type: "required",
            brand: "required",
            model: "required",
            price:"required",
            category:"required",
            insurance:"required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
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
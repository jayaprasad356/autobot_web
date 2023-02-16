<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
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

	      $error = array();
		  $brand = $db->escapeString(($_POST['brand']));
          $type = $db->escapeString(($_POST['type']));
		  $warranty = $db->escapeString($_POST['warranty']);
		  $amount = $db->escapeString($_POST['amount']);
		  $delivery_charges = $db->escapeString($_POST['delivery_charges']);
		  $fitting_charges = $db->escapeString($_POST['fitting_charges']);
		  $actual_price = $db->escapeString($_POST['actual_price']);
		  $final_price = $db->escapeString($_POST['final_price']);
		  $status = $db->escapeString($_POST['status']);

		  if (!empty($brand) && !empty($type) && !empty($warranty) &&!empty($amount) && !empty($delivery_charges) && !empty($fitting_charges)&& !empty($actual_price)&& !empty($final_price)) 
       {   
                if ($_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0 && !empty($_FILES['image'])) {
                    //image isn't empty and update the image
                    $old_image = $db->escapeString($_POST['old_image']);
                    $extension = pathinfo($_FILES["image"]["name"])['extension'];
            
                    $result = $fn->validate_image($_FILES["image"]);
                    $target_path = 'upload/products/';
                    
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
                    $upload_image = 'upload/products/' . $filename;
                    $sql = "UPDATE batteries SET `image`='" . $upload_image . "' WHERE `id`=" . $ID;
                    $db->sql($sql);
                }

				$sql_query = "UPDATE batteries SET brand='$brand',type='$type',warranty='$warranty',amount='$amount',delivery_charges='$delivery_charges',fitting_charges='$fitting_charges',actual_price='$actual_price',final_price='$final_price',status='$status' WHERE id=$ID";
				$db->sql($sql_query);
				$update_result = $db->getResult();
				if (!empty($update_result)) {
					$update_result = 0;
				} else {
					$update_result = 1;
				}

				// check update result
				if ($update_result == 1) {
					
					$error['update_battery'] = " <section class='content-header'><span class='label label-success'>Battery Details updated Successfully</span></section>";
				} else {
					$error['update_battery'] = " <span class='label label-danger'>Failed to update</span>";
				}
			}
	} 


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM batteries WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "batteries.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Battery<small><a href='batteries.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Batteries</a></small></h1>
	<small><?php echo isset($error['update_battery']) ? $error['update_battery'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-8">
		
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_battery_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
                        <input type="hidden" id="old_image" name="old_image"  value="<?= $res[0]['image']; ?>">
                        <div class="row">
                            <div class="form-group">
                                   <div class="col-md-6">
                                        <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i><?php echo isset($error['brand']) ? $error['brand'] : ''; ?>
                                        <input type="text" class="form-control" name="brand" value="<?php echo $res[0]['brand']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Type</label> <i class="text-danger asterik">*</i>
										<select id="type" name="type" class="form-control">
										    <option value="">select</option>
											<option value="Self start"<?=$res[0]['type'] == 'Self start' ? ' selected="selected"' : '';?>>Self start</option>
											<option value="Non-Self start"<?=$res[0]['type'] == 'Non-Self start' ? ' selected="selected"' : '';?> >Non-Self start</option>
										</select>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">warranty</label><i class="text-danger asterik">*</i><?php echo isset($error['warranty']) ? $error['warranty'] : ''; ?>
                                        <input type="number" class="form-control" name="warranty" value="<?php echo $res[0]['warranty']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Amount</label><i class="text-danger asterik">*</i><?php echo isset($error['amount']) ? $error['amount'] : ''; ?>
                                        <input type="number" class="form-control" name="amount" value="<?php echo $res[0]['amount']; ?>">
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Delivery Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['delivery_charges']) ? $error['delivery_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="delivery_charges" value="<?php echo $res[0]['delivery_charges']; ?>">
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Fitting Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['fitting_charges']) ? $error['fitting_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="fitting_charges" value="<?php echo $res[0]['fitting_charges']; ?>">
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Actual Price</label><i class="text-danger asterik">*</i><?php echo isset($error['actual_price']) ? $error['actual_price'] : ''; ?>
                                        <input type="number" class="form-control" name="actual_price" value="<?php echo $res[0]['actual_price']; ?>">
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Final Price</label><i class="text-danger asterik">*</i><?php echo isset($error['final_price']) ? $error['final_price'] : ''; ?>
                                        <input type="number" class="form-control" name="final_price" value="<?php echo $res[0]['final_price']; ?>">
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-4">
									     <label for="exampleInputFile">Image</label>
                                        <input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="image" id="image">
                                        <p class="help-block"><img id="blah" src="<?php echo $res[0]['image']; ?>" style="max-width:100%" /></p>
									</div>
                                   <div class='col-md-6'>
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

					</div>
					<!-- /.box-body -->
                       
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
					
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


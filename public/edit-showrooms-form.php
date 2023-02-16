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
$sql = "SELECT * FROM showrooms WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
if (isset($_POST['btnEdit'])) {

	$store_name = $db->escapeString(($_POST['store_name']));
	$email_id = $db->escapeString($_POST['email_id']);
	$mobile = $db->escapeString($_POST['mobile']);
	$password = $db->escapeString($_POST['password']);
	$address = $db->escapeString($_POST['address']);
	$brand = $db->escapeString($_POST['brand']);
	$latitude = $db->escapeString($_POST['latitude']);
	$longitude = $db->escapeString($_POST['longitude']);
	$status = $db->escapeString($_POST['status']);
	$permission = $db->escapeString($_POST['permission']);
	$error = array();

	if (empty($store_name)) {
		$error['store_name'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($email_id)) {
		$error['email_id'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($mobile)) {
		$error['mobile'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($password)) {
		$error['password'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($latitude)) {
		$error['latitude'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($longitude)) {
		$error['longitude'] = " <span class='label label-danger'>Required!</span>";
	}

	
	if (!empty($store_name) && !empty($email_id) && !empty($mobile) && !empty($password) && !empty($latitude) && !empty($longitude)) {
		$sql_query = "UPDATE showrooms SET store_name = '$store_name', email_id = '$email_id', mobile = '$mobile', password = '$password', address = '$address', brand = '$brand', latitude = '$latitude', longitude = '$longitude',status='$status',permission='$permission' WHERE id = '$ID'";
		$db->sql($sql_query);
		$res = $db->getResult();
		$update_showroom = $db->getResult();
		if (!empty($update_showroom)) {
			$update_showroom = 0;
		} else {
			$update_showroom = 1;
		}

		// check update result
		if ($update_showroom == 1) {
			$error['update_showroom'] = " <section class='content-header'><span class='label label-success'>Showroom Details updated Successfully</span></section>";
		} else {
			$error['update_showroom'] = " <span class='label label-danger'>Failed to update</span>";
		}
	}
}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM showrooms WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "showrooms.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Showroom<small><a href='showrooms.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Showrooms</a></small></h1>
	<small><?php echo isset($error['update_showroom']) ? $error['update_showroom'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-12">

			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Showroom</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_showroom_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="form-group">
								<div class='col-md-3'>
									<label for="exampleInputEmail1">Store Name</label><?php echo isset($error['store_name']) ? $error['store_name'] : ''; ?>
									<input type="text" class="form-control" name="store_name" value="<?php echo $res[0]['store_name']; ?>">

								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Email-ID</label><?php echo isset($error['email_id']) ? $error['email_id'] : ''; ?>
									<input type="text" class="form-control" name="email_id" value="<?php echo $res[0]['email_id']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Mobile</label><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
									<input type="text" class="form-control" name="mobile" value="<?php echo $res[0]['mobile']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Password</label><?php echo isset($error['password']) ? $error['password'] : ''; ?>
									<input type="text" class="form-control" name="password" value="<?php echo $res[0]['password']; ?>">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label for="exampleInputEmail1">Address</label><?php echo isset($error['address']) ? $error['address'] : ''; ?>
									<input type="text" class="form-control" name="address" value="<?php echo $res[0]['address']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Brand</label><?php echo isset($error['brand']) ? $error['brand'] : ''; ?>
									<input type="text" class="form-control" name="brand" value="<?php echo $res[0]['brand']; ?>">
								</div>

								<div class="col-md-3">
									<label for="exampleInputEmail1">Latitude</label><?php echo isset($error['latitude']) ? $error['latitude'] : ''; ?>
									<input type="text" class="form-control" name="latitude" value="<?php echo $res[0]['latitude']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Longitude</label><?php echo isset($error['longitude']) ? $error['longitude'] : ''; ?>
									<input type="text" class="form-control" name="longitude" value="<?php echo $res[0]['longitude']; ?>">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
								<div class="form-group col-md-4">
									<label class="control-label">Status</label><i class="text-danger asterik">*</i><br>
									<div id="status" class="btn-group">
										<label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Not-verified
										</label>
										<label class="btn btn-success" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
											<input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Verified
										</label>
									</div>
								</div>
								<div class="form-group col-md-3">
                                        <label for="">Update Permission</label><br>
                                        <input type="checkbox" id="permission_button" class="js-switch" <?= isset($res[0]['permission']) && $res[0]['permission'] == 1 ? 'checked' : '' ?>>
                                        <input type="hidden" id="permission_status" name="permission" value="<?= isset($res[0]['permission']) && $res[0]['permission'] == 1 ? 1 : 0 ?>">
                                </div>
						</div>





					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>

					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script>
    var changeCheckbox = document.querySelector('#permission_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#permission_status').val(1);

        } else {
            $('#permission_status').val(0);
        }
    };
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
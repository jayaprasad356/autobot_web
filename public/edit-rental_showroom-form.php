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
$sql = "SELECT * FROM rental_showrooms WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
if (isset($_POST['btnEdit'])) {

	$name = $db->escapeString(($_POST['name']));
	$email = $db->escapeString($_POST['email']);
	$mobile = $db->escapeString($_POST['mobile']);
	$password = $db->escapeString($_POST['password']);
	$location = $db->escapeString($_POST['location']);
	$address = $db->escapeString($_POST['address']);
	$pincode = $db->escapeString($_POST['pincode']);
	$bank_account_number = $db->escapeString($_POST['bank_account_number']);
	$ifsc_code = $db->escapeString($_POST['ifsc_code']);
	$bank_name = $db->escapeString($_POST['bank_name']);
	$branch = $db->escapeString($_POST['branch']);
	$status = $db->escapeString($_POST['status']);
	$permission = $db->escapeString($_POST['permission']);
	$error = array();

	if (empty($name)) {
		$error['name'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($email)) {
		$error['email'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($mobile)) {
		$error['mobile'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($password)) {
		$error['password'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($location)) {
		$error['location'] = " <span class='label label-danger'>Required!</span>";
	}

	
	if (!empty($name) && !empty($email) && !empty($mobile) && !empty($password)) {
		$sql_query = "UPDATE rental_showrooms SET name='$name',email = '$email', mobile = '$mobile', password = '$password', location = '$location',status='$status',permission='$permission',address='$address',pincode='$pincode',bank_account_number='$bank_account_number',ifsc_code='$ifsc_code',bank_name='$bank_name',branch='$branch' WHERE id = '$ID'";
		$db->sql($sql_query);
		$res = $db->getResult();
		$update_rental = $db->getResult();
		if (!empty($update_rental)) {
			$update_rental = 0;
		} else {
			$update_rental = 1;
		}

		// check update result
		if ($update_rental == 1) {
			$error['update_rental'] = " <section class='content-header'><span class='label label-success'>Rental Showroom Details updated Successfully</span></section>";
		} else {
			$error['update_rental'] = " <span class='label label-danger'>Failed to update</span>";
		}
	}
}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM rental_showrooms WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "rental_showrooms.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit ental Showrooms<small><a href='rental_showrooms.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Rental Showrooms</a></small></h1>
	<small><?php echo isset($error['update_rental']) ? $error['update_rental'] : ''; ?></small>
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
					<h3 class="box-title">Edit rental Showrooms</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_seller_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="form-group">
						     	<div class="col-md-4">
									<label for="exampleInputEmail1">Name</label><i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
									<input type="text" class="form-control" name="name" value="<?php echo $res[0]['name']; ?>">
								</div>
								<div class="col-md-4">
									<label for="exampleInputEmail1">Email-ID</label><i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
									<input type="email" class="form-control" name="email" value="<?php echo $res[0]['email']; ?>">
								</div>
								<div class="col-md-4">
									<label for="exampleInputEmail1">Mobile</label><i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
									<input type="number" class="form-control" name="mobile" value="<?php echo $res[0]['mobile']; ?>">
								</div>
					
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-4">
									<label for="exampleInputEmail1">Password</label><i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
									<input type="text" class="form-control" name="password" value="<?php echo $res[0]['password']; ?>">
								</div>
								<div class="col-md-4">
									<label for="exampleInputEmail1">location</label><i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
									<input type="text" class="form-control" name="location" value="<?php echo $res[0]['location']; ?>">
							    </div>
								<div class="col-md-4">
									<label for="exampleInputEmail1">Address</label><i class="text-danger asterik">*</i><?php echo isset($error['address']) ? $error['address'] : ''; ?>
									<input type="text" class="form-control" name="address" value="<?php echo $res[0]['address']; ?>">
							    </div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label for="exampleInputEmail1">Account Number</label><i class="text-danger asterik">*</i><?php echo isset($error['bank_account_number']) ? $error['bank_account_number'] : ''; ?>
									<input type="text" class="form-control" name="bank_account_number" value="<?php echo $res[0]['bank_account_number']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">IFSC Code</label><i class="text-danger asterik">*</i><?php echo isset($error['ifsc_code']) ? $error['ifsc_code'] : ''; ?>
									<input type="text" class="form-control" name="ifsc_code" value="<?php echo $res[0]['ifsc_code']; ?>">
							    </div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Bank Name</label><i class="text-danger asterik">*</i><?php echo isset($error['bank_name']) ? $error['bank_name'] : ''; ?>
									<input type="text" class="form-control" name="bank_name" value="<?php echo $res[0]['bank_name']; ?>">
							    </div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Branch</label><i class="text-danger asterik">*</i><?php echo isset($error['branch']) ? $error['branch'] : ''; ?>
									<input type="text" class="form-control" name="branch" value="<?php echo $res[0]['branch']; ?>">
							    </div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
							    <div class="col-md-4">
									<label for="exampleInputEmail1">Pincode</label><i class="text-danger asterik">*</i><?php echo isset($error['pincode']) ? $error['pincode'] : ''; ?>
									<input type="text" class="form-control" name="pincode" value="<?php echo $res[0]['pincode']; ?>">
							    </div>
								<div class="col-md-2">
                                        <label for="">Update Permission</label><br>
                                        <input type="checkbox" id="permission_button" class="js-switch" <?= isset($res[0]['permission']) && $res[0]['permission'] == 1 ? 'checked' : '' ?>>
                                        <input type="hidden" id="permission_status" name="permission" value="<?= isset($res[0]['permission']) && $res[0]['permission'] == 1 ? 1 : 0 ?>">
                                </div>
								<div class="col-md-4">
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
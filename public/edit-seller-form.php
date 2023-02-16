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
$sql = "SELECT * FROM seller WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
if (isset($_POST['btnEdit'])) {

	$name = $db->escapeString(($_POST['name']));
	$store_name = $db->escapeString(($_POST['store_name']));
	$email = $db->escapeString($_POST['email']);
	$mobile = $db->escapeString($_POST['mobile']);
	$password = $db->escapeString($_POST['password']);
	$street = $db->escapeString($_POST['street']);
	$state = $db->escapeString($_POST['state']);
	$latitude = $db->escapeString($_POST['latitude']);
	$longitude = $db->escapeString($_POST['longitude']);
	$account_number = $db->escapeString($_POST['account_number']);
	$bank_ifsc_code = $db->escapeString($_POST['bank_ifsc_code']);
	$account_name = $db->escapeString($_POST['account_name']);
	$bank_name = $db->escapeString($_POST['bank_name']);
	$status = $db->escapeString($_POST['status']);
	$permission = $db->escapeString($_POST['permission']);
	$error = array();

	if (empty($name)) {
		$error['name'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($store_name)) {
		$error['store_name'] = " <span class='label label-danger'>Required!</span>";
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
	// if (empty($street)) {
	// 	$error['street'] = " <span class='label label-danger'>Required!</span>";
	// }
	// if (empty($state)) {
	// 	$error['state'] = " <span class='label label-danger'>Required!</span>";
	// }
	// if (empty($latitude)) {
	// 	$error['latitude'] = " <span class='label label-danger'>Required!</span>";
	// }
	// if (empty($longitude)) {
	// 	$error['longitude'] = " <span class='label label-danger'>Required!</span>";
	// }

	
	if (!empty($store_name) && !empty($email) && !empty($mobile) && !empty($password)) {
		$sql_query = "UPDATE seller SET name='$name',store_name = '$store_name', email = '$email', mobile = '$mobile', password = '$password', street = '$street', state = '$state', latitude = '$latitude', longitude = '$longitude',account_number='$account_number',bank_ifsc_code='$bank_ifsc_code',account_name='$account_name',bank_name='$bank_name',status='$status',permission='$permission' WHERE id = '$ID'";
		$db->sql($sql_query);
		$res = $db->getResult();
		$update_seller = $db->getResult();
		if (!empty($update_seller)) {
			$update_seller = 0;
		} else {
			$update_seller = 1;
		}

		// check update result
		if ($update_seller == 1) {
			$error['update_seller'] = " <section class='content-header'><span class='label label-success'>Seller Details updated Successfully</span></section>";
		} else {
			$error['update_seller'] = " <span class='label label-danger'>Failed to update</span>";
		}
	}
}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM seller WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "sellers.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Seller<small><a href='sellers.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Sellers</a></small></h1>
	<small><?php echo isset($error['update_seller']) ? $error['update_seller'] : ''; ?></small>
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
					<h3 class="box-title">Edit Seller</h3>
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
								<div class='col-md-4'>
									<label for="exampleInputEmail1">Store Name</label><i class="text-danger asterik">*</i><?php echo isset($error['store_name']) ? $error['store_name'] : ''; ?>
									<input type="text" class="form-control" name="store_name" value="<?php echo $res[0]['store_name']; ?>">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
							    <div class="col-md-4">
									<label for="exampleInputEmail1">Email-ID</label><i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
									<input type="email" class="form-control" name="email" value="<?php echo $res[0]['email']; ?>">
								</div>
						     	<div class="col-md-3">
									<label for="exampleInputEmail1">Mobile</label><i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
									<input type="number" class="form-control" name="mobile" value="<?php echo $res[0]['mobile']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Password</label><i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
									<input type="text" class="form-control" name="password" value="<?php echo $res[0]['password']; ?>">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label for="exampleInputEmail1">Street</label><i class="text-danger asterik">*</i><?php echo isset($error['street']) ? $error['street'] : ''; ?>
									<input type="text" class="form-control" name="street" value="<?php echo $res[0]['street']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">State</label><i class="text-danger asterik">*</i><?php echo isset($error['state']) ? $error['state'] : ''; ?>
									<input type="text" class="form-control" name="state" value="<?php echo $res[0]['state']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Latitude</label><i class="text-danger asterik">*</i><?php echo isset($error['latitude']) ? $error['latitude'] : ''; ?>
									<input type="text" class="form-control" name="latitude" value="<?php echo $res[0]['latitude']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Longitude</label><i class="text-danger asterik">*</i><?php echo isset($error['longitude']) ? $error['longitude'] : ''; ?>
									<input type="text" class="form-control" name="longitude" value="<?php echo $res[0]['longitude']; ?>">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label for="exampleInputEmail1">Account Number</label><?php echo isset($error['account_number']) ? $error['account_number'] : ''; ?>
									<input type="number" class="form-control" name="account_number" value="<?php echo $res[0]['account_number']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">IFSC Code</label><?php echo isset($error['bank_ifsc_code']) ? $error['bank_ifsc_code'] : ''; ?>
									<input type="text" class="form-control" name="bank_ifsc_code" value="<?php echo $res[0]['bank_ifsc_code']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Holder Name</label><?php echo isset($error['account_name']) ? $error['account_name'] : ''; ?>
									<input type="text" class="form-control" name="account_name" value="<?php echo $res[0]['account_name']; ?>">
								</div>
								<div class="col-md-3">
									<label for="exampleInputEmail1">Bank Name</label><?php echo isset($error['bank_name']) ? $error['bank_name'] : ''; ?>
									<input type="text" class="form-control" name="bank_name" value="<?php echo $res[0]['bank_name']; ?>">
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
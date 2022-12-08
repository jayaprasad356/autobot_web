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
		  $bike_id = $db->escapeString(($_POST['bike_id']));
		  $tyre_type = $db->escapeString($_POST['tyre_type']);
		  $wheel = $db->escapeString($_POST['wheel']);
		  $price = $db->escapeString($_POST['price']);
		  $status = $db->escapeString($_POST['status']);

		  if (!empty($bike_id) && !empty($tyre_type) && !empty($wheel)&& !empty($price)) 
          {  
				$sql_query = "UPDATE puncture_services SET bike_id='$bike_id',tyre_type='$tyre_type',wheel='$wheel',price='$price',status='$status' WHERE id=$ID";
				$db->sql($sql_query);
				$update_result = $db->getResult();
				if (!empty($update_result)) {
					$update_result = 0;
				} else {
					$update_result = 1;
				}

				// check update result
				if ($update_result == 1) {
					
					$error['update_service'] = " <section class='content-header'><span class='label label-success'>Bike Puncture Services updated Successfully</span></section>";
				} else {
					$error['update_service'] = " <span class='label label-danger'>Failed to update</span>";
				}
			}
	} 


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM puncture_services WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "puncture_services.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Bike Puncture Service<small><a href='puncture_services.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Bike Puncture Service</a></small></h1>
	<small><?php echo isset($error['update_service']) ? $error['update_service'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-10">
		
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_puncture_service_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="form-group">
								<div class="col-md-6">
								    <label for="exampleInputEmail1">Choose Bike</label><i class="text-danger asterik">*</i>
									<select id='bike_id' name="bike_id" class='form-control' required>
									   <option value="none">-- Select --</option>
												<?php
													$sql = "SELECT * FROM `bikes`";
													$db->sql($sql);
													$result = $db->getResult();
													foreach ($result as $value) {
												?>
													<option value='<?= $value['id'] ?>' <?= $value['id']==$res[0]['bike_id'] ? 'selected="selected"' : '';?>><?= $value['bike_name'] ?></option>
												<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
                            <div class="form-group">
                                    <div class="col-md-4">
									    <label class="control-label">Tyre Type</label> <i class="text-danger asterik">*</i><br>
                                        <div id="tyre_type" class="btn-group">
                                            <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="tyre_type" value="Tube-tyre" <?= ($res[0]['tyre_type'] == "Tube-tyre") ? 'checked' : ''; ?>>Tube Tyre
                                            </label>
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="tyre_type" value="Tubeless-tyre" <?= ($res[0]['tyre_type'] == "Tubeless-tyre") ? 'checked' : ''; ?>> Tubeless Tyre
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
									    <label for="">Wheel</label> <i class="text-danger asterik">*</i>
										<select id="wheel" name="wheel" class="form-control">
										    <option value="">select</option>
											<option value="Front"<?=$res[0]['wheel'] == 'Front' ? ' selected="selected"' : '';?>>Front</option>
											<option value="Rear"<?=$res[0]['wheel'] == 'Rear' ? ' selected="selected"' : '';?> >Rear</option>
										</select>
                                    </div>
									<div class="col-md-4">
                                        <label for="exampleInputEmail1">Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                        <input type="number" class="form-control" name="price"  value="<?php echo $res[0]['price']; ?>">
                                    </div>
                            </div>
                        </div>
                         <br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-6">
									<label for="">Status</label> <i class="text-danger asterik">*</i>
										<select id="status" name="status" class="form-control">
										<option value="1"<?=$res[0]['status'] == '1' ? ' selected="selected"' : '';?>>Booked</option>
											<option value="2"<?=$res[0]['status'] == '2' ? ' selected="selected"' : '';?>>Completed</option>
											<option value="0"<?=$res[0]['status'] == '0' ? ' selected="selected"' : '';?> >Cancelled</option>
										</select>
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
<?php $db->disconnect(); ?>


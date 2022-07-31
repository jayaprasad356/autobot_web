<?php
include_once('../includes/functions.php');
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
$ID = (isset($_GET['id'])) ? $db->escapeString($fn->xss_clean($_GET['id'])) : "";
$ID = $_SESSION['mechanic_id'];
// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM mechanic WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content">
    <!-- Main row -->

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Mechanic</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" id="update_seller" name="update_seller" required="" value="1" aria-required="true">
                            <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="name" id="name" value="<?= $res[0]['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Mobile</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?= $res[0]['mobile']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Password</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="password" id="password" value="<?= $res[0]['password']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Address</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="address" id="address" value="<?= $res[0]['password']; ?>" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">District</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" id='district' name="district" value="<?= $res[0]['district']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Pincode</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="pincode" id="pincode" value="<?= $res[0]['pincode']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label><i class="text-danger asterik">*</i>
                                        
                                        <select name="state" id="state" class="form-control">
                                            <option <?=$res[0]['state'] == 'Andhra Pradesh' ? ' selected="selected"' : '';?> value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Andaman and Nicobar Islands' ? ' selected="selected"' : '';?> value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option <?=$res[0]['state'] == 'Arunachal Pradesh' ? ' selected="selected"' : '';?> value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Assam' ? ' selected="selected"' : '';?> value="Assam">Assam</option>
                                            <option <?=$res[0]['state'] == 'Bihar' ? ' selected="selected"' : '';?> value="Bihar">Bihar</option>
                                            <option <?=$res[0]['state'] == 'Chandigarh' ? ' selected="selected"' : '';?> value="Chandigarh">Chandigarh</option>
                                            <option <?=$res[0]['state'] == 'Chhattisgarh' ? ' selected="selected"' : '';?> value="Chhattisgarh">Chhattisgarh</option>
                                            <option <?=$res[0]['state'] == 'Dadar and Nagar Haveli' ? ' selected="selected"' : '';?> value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option <?=$res[0]['state'] == 'Daman and Diu' ? ' selected="selected"' : '';?> value="Daman and Diu">Daman and Diu</option>
                                            <option <?=$res[0]['state'] == 'Delhi' ? ' selected="selected"' : '';?> value="Delhi">Delhi</option>
                                            <option <?=$res[0]['state'] == 'Lakshadweep' ? ' selected="selected"' : '';?> value="Lakshadweep">Lakshadweep</option>
                                            <option <?=$res[0]['state'] == 'Puducherry' ? ' selected="selected"' : '';?> value="Puducherry">Puducherry</option>
                                            <option <?=$res[0]['state'] == 'Goa' ? ' selected="selected"' : '';?> value="Goa">Goa</option>
                                            <option <?=$res[0]['state'] == 'Gujarat' ? ' selected="selected"' : '';?> value="Gujarat">Gujarat</option>
                                            <option <?=$res[0]['state'] == 'Haryana' ? ' selected="selected"' : '';?> value="Haryana">Haryana</option>
                                            <option <?=$res[0]['state'] == 'Himachal Pradesh' ? ' selected="selected"' : '';?> value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Jammu and Kashmir' ? ' selected="selected"' : '';?> value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option <?=$res[0]['state'] == 'Jharkhand' ? ' selected="selected"' : '';?> value="Jharkhand">Jharkhand</option>
                                            <option <?=$res[0]['state'] == 'Karnataka' ? ' selected="selected"' : '';?> value="Karnataka">Karnataka</option>
                                            <option <?=$res[0]['state'] == 'Kerala' ? ' selected="selected"' : '';?> value="Kerala">Kerala</option>
                                            <option <?=$res[0]['state'] == 'Madhya Pradesh' ? ' selected="selected"' : '';?> value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Maharashtra' ? ' selected="selected"' : '';?> value="Maharashtra">Maharashtra</option>
                                            <option <?=$res[0]['state'] == 'Manipur' ? ' selected="selected"' : '';?> value="Manipur">Manipur</option>
                                            <option <?=$res[0]['state'] == 'Meghalaya' ? ' selected="selected"' : '';?> value="Meghalaya">Meghalaya</option>
                                            <option <?=$res[0]['state'] == 'Mizoram' ? ' selected="selected"' : '';?> value="Mizoram">Mizoram</option>
                                            <option <?=$res[0]['state'] == 'Nagaland' ? ' selected="selected"' : '';?> value="Nagaland">Nagaland</option>
                                            <option <?=$res[0]['state'] == 'Odisha' ? ' selected="selected"' : '';?> value="Odisha">Odisha</option>
                                            <option <?=$res[0]['state'] == 'Punjab' ? ' selected="selected"' : '';?> value="Punjab">Punjab</option>
                                            <option <?=$res[0]['state'] == 'Rajasthan' ? ' selected="selected"' : '';?> value="Rajasthan">Rajasthan</option>
                                            <option <?=$res[0]['state'] == 'Sikkim' ? ' selected="selected"' : '';?> value="Sikkim">Sikkim</option>
                                            <option <?=$res[0]['state'] == 'Tamil Nadu' ? ' selected="selected"' : '';?> value="Tamil Nadu">Tamil Nadu</option>
                                            <option <?=$res[0]['state'] == 'Telangana' ? ' selected="selected"' : '';?> value="Telangana">Telangana</option>
                                            <option <?=$res[0]['state'] == 'Tripura' ? ' selected="selected"' : '';?> value="Tripura">Tripura</option>
                                            <option <?=$res[0]['state'] == 'Uttar Pradesh' ? ' selected="selected"' : '';?> value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Uttarakhand' ? ' selected="selected"' : '';?> value="Uttarakhand">Uttarakhand</option>
                                            <option <?=$res[0]['state'] == 'West Bengal' ? ' selected="selected"' : '';?> value="West Bengal">West Bengal</option>
                                        </select>

                                    </div>
                               </div>
                            </div>
                            
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="submit_btn">Update</button><br>
                                <div style="display:none;" id="result"></div>

                            </div>
                        </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>


<script>
    $('#edit_form').validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
                },
                pincode: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
                },
                address: "required",
            
        }

    });
    $('#edit_form').on('submit', function(e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        if ($("#edit_form").validate().form()) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                beforeSend: function() {
                    $('#submit_btn').html('Please wait..');
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    $('#result').html(result);
                    $('#result').show().delay(6000).fadeOut();
                    $('#cat_ids').select2({
                        placeholder: "type in category name to search"
                    });
                    //alert("Profile Updated Successfully");
                    //$('#submit_btn').html('Update');
                    
                    function showpanel() {     
                            

                        location.reload(true);
                    }

                    setTimeout(showpanel, 3000)
                }
            });
        }
    });
</script>
<?php $db->disconnect(); ?>
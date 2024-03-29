<?php
// start session

session_start();

// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;

// if session not set go to login page
if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['seller_id'];
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;

include "header.php"; ?>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/ico" href="../dist/img/logo.png">
    <title>Seller Profile |  - Dashboard</title>
    <style>
        .mce-notification.mce-in{
        display: none !important;
    }
    </style>
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php
        $sql_query = "SELECT * FROM seller WHERE id ='" . $ID . "'";
        // create array variable to store previous data
        $data = array();
        // Execute query
        $db->sql($sql_query);
        // store result 
        $res = $db->getResult();
        $previous_password = $res[0]['password'];
        ?>

        <section class="content-header">
            <h1>Seller</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php"> <i class="fa fa-home"></i> Home</a>
                </li>
            </ol>
            <?php echo isset($error['update_user']) ? $error['update_user'] : ''; ?>
            <hr />
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
                        <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                            <div class="box-body">
                                <input type="hidden" id="update_seller" name="update_seller" required="" value="1" aria-required="true">
                                <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                                <input type="hidden" id="hide_description" name="hide_description">
                                <input type="hidden" id="old_logo" name="old_logo" required value="<?= $res[0]['logo']; ?>">
                                <input type="hidden" id="old_national_identity_card" name="old_national_identity_card" required value="<?= $res[0]['national_identity_card']; ?>">
                                <input type="hidden" id="old_address_proof" name="old_address_proof" required value="<?= $res[0]['address_proof']; ?>">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Name</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="name" id="name" value="<?= $res[0]['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label><i class="text-danger asterik">*</i>
                                            <input type="email" class="form-control" name="email" id="email" value="<?= $res[0]['email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Store Name</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="store_name" id="store_name" value="<?= $res[0]['store_name']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Mobile</label><i class="text-danger asterik">*</i>
                                            <input type="number" class="form-control" name="mobile" id="mobile" value="<?= $res[0]['mobile']; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Store URL</label>
                                            <input type="text" class="form-control" name="store_url" id="store_url" value="<?= $res[0]['store_url']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Old Password :</label><i class="text-danger asterik">*</i><small>( Leave it blank for no change )</small>
                                            <input type="text" class="form-control" name="old_password" id="old_password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">New Password</label><i class="text-danger asterik">*</i><small>( Leave it blank for no change )</small>
                                            <input type="text" class="form-control" name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Confirm Password</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="confirm_password" id="confirm_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Commission (%)</label>
                                            <input type="number" class="form-control" name="commission" id="commission" value="<?= $res[0]['commission']; ?>" required disabled><br>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Tax Name</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="tax_name" value="<?= $res[0]['tax_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Tax Number</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="tax_number" value="<?= $res[0]['tax_number']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Street</label>
                                            <input type="text" class="form-control" name="street" id="street" value="<?= $res[0]['street']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                           <label for="">Pincode</label>
                                            <input type="text" class="form-control" name="pincode_id" id="pincode_id" value="<?= $res[0]['pincode_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" class="form-control" name="state" id="state" value="<?= $res[0]['state']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-md-3">
                                        <div class="form-group">
                                            <label for="">Bank's IFSC Code</label>
                                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?= $res[0]['bank_ifsc_code']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input type="number" class="form-control" name="account_number" id="account_number" value="<?= $res[0]['account_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-group">
                                            <label for="">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?= $res[0]['bank_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-group">
                                            <label for=""> Account Holder Name</label>
                                            <input type="text" class="form-control" name="account_name" id="account_name" value="<?= $res[0]['account_name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Latitude</label>
                                            <input type="number" class="form-control" name="latitude" id="latitude" value="<?= $res[0]['latitude']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">Longitude</label>
                                            <input type="text" class="form-control" name="longitude" id="longitude" value="<?= $res[0]['longitude']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="">PAN Number</label>
                                            <input type="text" class="form-control" name="pan_number" value="<?= $res[0]['pan_number']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Logo</label><i class="text-danger asterik">*</i>
                                            <input type="file" name="store_logo" id="store_logo">
                                            <p class="help-block"><img src="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['logo']; ?>" style="max-width:100%" /></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">National Identity Card</label><i class="text-danger asterik">*</i>
                                            <input type="file" name="national_id_card" id="national_id_card">
                                            <p class="help-block"><img src="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['national_identity_card']; ?>" style="max-width:100%" /></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Address Proof</label><i class="text-danger asterik">*</i>
                                            <input type="file" name="address_proof" id="address_proof">
                                            <p class="help-block"><img src="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['address_proof']; ?>" style="max-width:100%" /></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="city_id">City</label>
                                            <?php $db->sql("SET NAMES 'utf8'");
                                            $sql = "SELECT * FROM cities ORDER BY id + 0 ASC";
                                            $db->sql($sql);
                                            $cities = $db->getResult();
                                            ?>
                                            <select id='city_id' name="city_id" class='form-control'>
                                                <option value=''>Select City</option>
                                                <?php foreach ($cities as $row) { ?>
                                                    <option value='<?= $row['id'] ?>'><?= $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <div class="form-group">
                                            <label for="description">Store Description :</label>
                                            <!-- <textarea name="store_description" id="store_description" class="form-control" rows="8"> <?= $res[0]['store_description']; ?></textarea> -->
                                            <textarea name="descriptions" id="descriptions" class="form-control" rows="16"><?php echo $res[0]['store_description']; ?></textarea>

                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label">Status</label><i class="text-danger asterik">*</i><br>

                                    <div id="status" class="btn-group">
                                        <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Deactivated
                                        </label>
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Activated
                                        </label>
                                    </div>
                                </div> -->
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
    </div><!-- /.content-wrapper -->
</body>

</html>
<?php include "footer.php"; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#descriptions'
    });
</script>
<script>
    $('#edit_form').validate({
        rules: {
            name: "required",
            mobile: "required",
            address: "required",
            descriptions: "required",
            confirm_password: {
                equalTo: "#password"
            }
        }
    });
    $('#cat_ids').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });

    // if (!CKEDITOR.env.ie || CKEDITOR.env.version > 7)
    //     CKEDITOR.env.isCompatible = true;
    $('#edit_form').on('submit', function(e) {
        e.preventDefault();
        // var content = $('textarea[name=descriptions]').val();
        var content = tinyMCE.activeEditor.getContent();
        $('#hide_description').val(content);
        var formData = new FormData(this);
        if ($("#edit_form").validate().form()) {
            if (confirm("Are you sure want to update profile?")) {
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
                        $('#submit_btn').html('Update');
                        location.reload(true);
                    }
                });
            }
        }
    });
</script>
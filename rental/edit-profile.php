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
    <title>Rental Showroom Profile |  - Dashboard</title>
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
        $sql_query = "SELECT * FROM rental_showrooms WHERE id ='" . $ID . "'";
        $data = array();
        $db->sql($sql_query);
        $res = $db->getResult();
        $previous_password = $res[0]['password'];

        ?>

        <section class="content-header">
        <h1>Rental Showrooms</h1>
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
                            <h3 class="box-title">Edit Rental Showroom</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                            <div class="box-body">
                                <input type="hidden" id="update_rental" name="update_rental" required="" value="1" aria-required="true">
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
                                            <label for="">Email</label><i class="text-danger asterik">*</i>
                                            <input type="email" class="form-control" name="email" id="email" value="<?= $res[0]['email']; ?>" required>
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
                                            <label for="">Location</label><i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="location" value="<?= $res[0]['location']; ?>"  id="location">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="submit_btn">Update</button><br>
                            </div>
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

<script>
    $('#edit_form').validate({
        rules: {
            name: "required",
            mobile: "required",
            confirm_password: {
                equalTo: "#password"
            }
        }
    });
    $('#cat_ids').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });

    
    $('#edit_form').on('submit', function(e) {
        e.preventDefault();
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
                        $('#submit_btn').html('Update');
                        location.reload(true);
                    }
                });
            }
        }
    });
</script>
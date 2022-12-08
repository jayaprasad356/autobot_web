<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {

    $store_name = $db->escapeString(($_POST['store_name']));
    $email_id = $db->escapeString($_POST['email_id']);
    $mobile = $db->escapeString($_POST['mobile']);
    $password = $db->escapeString($_POST['password']);
    $address = $db->escapeString($_POST['address']);
    $brand = $db->escapeString($_POST['brand']);
    $latitude = $db->escapeString($_POST['latitude']);
    $longitude = $db->escapeString($_POST['longitude']);



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
    if (empty($address)) {
        $error['address'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($brand)) {
        $error['brand'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($latitude)) {
        $error['latitude'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($longitude)) {
        $error['longitude'] = " <span class='label label-danger'>Required!</span>";
    }


    if (!empty($store_name) && !empty($email_id) && !empty($mobile) && !empty($password) && !empty($address) && !empty($brand) && !empty($latitude) && !empty($longitude)) {

        $sql_query = "INSERT INTO showrooms (store_name,email_id,mobile,password,address,brand,latitude,longitude)VALUES('$store_name','$email_id','$mobile','$password','$address','$brand','$latitude','$longitude')";
        $db->sql($sql_query);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }

        if ($result == 1) {
            $error['add_rental_category'] = "<section class='content-header'>
                                                <span class='label label-success'>Rental Category Added Successfully</span> </section>";
        } else {
            $error['add_rental_category'] = " <span class='label label-danger'>Failed</span>";
        }
    }
}
?>
<section class="content-header">
    <h1>Add Showroom <small><a href='showrooms.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Showrooms</a></small></h1>

    <?php echo isset($error['add_rental_category']) ? $error['add_rental_category'] : ''; ?>
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

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_product" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="exampleInputEmail1">Store Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['store_name']) ? $error['store_name'] : ''; ?>
                                <input type="text" class="form-control" name="store_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="exampleInputEmail1">Email ID</label> <i class="text-danger asterik">*</i><?php echo isset($error['email_id']) ? $error['email_id'] : ''; ?>
                                <input type="text" class="form-control" name="email_id" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="text" class="form-control" name="mobile" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Password</label> <i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Address</label> <i class="text-danger asterik">*</i><?php echo isset($error['address']) ? $error['address'] : ''; ?>
                                    <input type="text" class="form-control" name="address" required>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Brand</label> <i class="text-danger asterik">*</i><?php echo isset($error['brand']) ? $error['brand'] : ''; ?>
                                    <input type="text" class="form-control" name="brand" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Latitude</label> <i class="text-danger asterik">*</i><?php echo isset($error['latitude']) ? $error['latitude'] : ''; ?>
                                    <input type="text" class="form-control" name="latitude" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Longitude</label> <i class="text-danger asterik">*</i><?php echo isset($error['longitude']) ? $error['longitude'] : ''; ?>
                                    <input type="text" class="form-control" name="longitude" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                    </div>

            </div>

            </form>

        </div><!-- /.box -->
    </div>
    </div>
</section>

<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_product').validate({

        ignore: [],
        debug: false,
        rules: {
            brand: "required",
            bike_name: "required",
            hills_price: "required",
            normal_price: "required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>

<!--code for page clear-->
<script>
    function refreshPage() {
        window.location.reload();
    }
</script>

<?php $db->disconnect(); ?>
<?php
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
$brand = '';
$bike_name = '';
$cc = '';
$hills_price = '';
$normal_price = '';
if (isset($_POST['btnView'])) {
    $rental_category_id = $db->escapeString($_POST['rental_category_id']);
    $sql="SELECT * FROM rental_category WHERE id = '$rental_category_id'";
    $db->sql($sql);
    $resslot = $db->getResult();
    $brand = $resslot[0]['brand'];
    $bike_name = $resslot[0]['bike_name'];
    $cc = $resslot[0]['cc'];
    $hills_price = $resslot[0]['hills_price'];
    $normal_price = $resslot[0]['normal_price'];


}
if (isset($_POST['btnAdd'])) {


        $rental_category_id = $db->escapeString($_POST['rental_category_id']);
        $pincode = $db->escapeString($_POST['pincode']);


        // get image info
        $menu_image = $db->escapeString($_FILES['bike_image']['name']);
        $image_error = $db->escapeString($_FILES['bike_image']['error']);
        $image_type = $db->escapeString($_FILES['bike_image']['type']);

        // create array variable to handle error
        $error = array();
            // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["bike_image"]["name"]));
        

        if (empty($rental_category_id)) {
            $error['rental_category_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($pincode)) {
            $error['pincode'] = " <span class='label label-danger'>Required!</span>";
        }


        if (!empty($rental_category_id) && !empty($pincode) ) {
            $result = $fn->validate_image($_FILES["bike_image"]);
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['bike_image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                // upload new image
                $upload = move_uploaded_file($_FILES['bike_image']['tmp_name'], '../upload/rentals/' . $menu_image);
        
                // insert new data to menu table
                $upload_image = $menu_image;
           
            $sql_query = "INSERT INTO rental_vehicles (rental_category_id,pincode,image,status) VALUES ('$rental_category_id','$pincode','$upload_image',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_vehicle'] = " <section class='content-header'><span class='label label-success'>Rental Vehicle Added Successfully</span></section>";
            } else {
                $error['add_vehicle'] = " <span class='label label-danger'>Failed!</span>";
            }
            }
        }

      

?>
<section class="content-header">
    <h1>Add Vehicle For Rent<small><a href='rental_vehicles.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Rental Vehicles</a></small></h1>

    <?php echo isset($error['add_vehicle']) ? $error['add_vehicle'] : ''; ?>
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

                </div><!-- /.box-header -->
                <form method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Bike Name</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_name']) ? $error['bike_name'] : ''; ?>
                                    <select id='rental_category_id' name="rental_category_id" class='form-control' required>
                                                <option value="">Select</option>
                                                            <?php
                                                            $sql = "SELECT id,bike_name FROM `rental_category`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
                                                                <option value='<?= $value['id'] ?>'><?= $value['bike_name'] ?></option>
                                                            <?php } ?>
                                        </select>                               
                               </div>
                            </div>
                            <div class="col-md-1">
                                  <button type="submit"  class="btn btn-primary" style="margin-top:24px;" name="btnView">View</button>                            
                            </div>
                        </div>

                    </div>
                </form>
                <!-- form start -->
                <form name="add_vehicle_form" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="rental_category_id"  value="<?php echo $rental_category_id ?>" readonly >
                    <div class="box-body">

                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bike Name</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="bike_name"  value="<?php echo $bike_name ?>" readonly >
                                </div>
                            </div>
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="brand"  value="<?php echo $brand ?>" readonly >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CC</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="cc" value="<?php echo $cc ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hills Price</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="hills_price" value="<?php echo $hills_price ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Normal Price</label><i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="normal_price" value="<?php echo $normal_price ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pincode</label><i class="text-danger asterik">*</i><?php echo isset($error['pincode']) ? $error['pincode'] : ''; ?>
                                    <input type="text" class="form-control" name="pincode" required>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_image']) ? $error['bike_image'] : ''; ?>
                                    <input type="file" name="bike_image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="bike_image" />
                                </div>
                                <div class="form-group">
                                    <img id="blah" src="#" alt="" />

                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" class="btn-warning btn" value="Clear" />
                    </div>
                </div>
                </form>
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
            pincode:"required",
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
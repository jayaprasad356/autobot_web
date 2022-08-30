<?php
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {


        $category = $db->escapeString($_POST['category']);
        $brand = $db->escapeString($_POST['brand']);
        $bike_name = $db->escapeString($_POST['bike_name']);
        $km_charge = $db->escapeString($_POST['km_charge']);
        $minute_charge = $db->escapeString($_POST['minute_charge']);
        $location = $db->escapeString($_POST['location']);


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
        

        if (empty($category)) {
            $error['category'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($bike_name)) {
            $error['bike_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($km_charge)) {
            $error['km_charge'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($minute_charge)) {
            $error['minute_charge'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }


        if (!empty($category) && !empty($brand) && !empty($bike_name) && !empty($km_charge) && !empty($minute_charge) && !empty($location)) {
            $result = $fn->validate_image($_FILES["bike_image"]);
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['bike_image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                // upload new image
                $upload = move_uploaded_file($_FILES['bike_image']['tmp_name'], '../upload/rentals/' . $menu_image);
        
                // insert new data to menu table
                $upload_image = 'upload/rentals/' . $menu_image;
           
            $sql_query = "INSERT INTO rental_vehicles (category,brand,bike_name,km_charge,minute_charge,location,image,status) VALUES ('$category','$brand','$bike_name','$km_charge','$minute_charge','$location','$upload_image',1)";
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
                <!-- form start -->
                <form name="add_vehicle_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Category</label><i class="text-danger asterik">*</i>
                                    <select id="category" name="category" class="form-control">
                                        <option value="#">Select</option>
                                        <option  value="City Booking">City Booking</option>
                                        <option value="Hills Ride">Hills Ride</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i>
                                        <select id='brand' name="brand" class='form-control' required>
                                                <option value="none">Select</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `models`";
                                                            $db->sql($sql);

                                                            $result = $db->getResult();
                                                            foreach ($result as $value) {
                                                            ?>
                                                                <option value='<?= $value['model'] ?>'><?= $value['model'] ?></option>
                                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Bike Name</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_name']) ? $error['bike_name'] : ''; ?>
                                    <input type="text" class="form-control" name="bike_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price/Km</label><i class="text-danger asterik">*</i><?php echo isset($error['km_charge']) ? $error['km_charge'] : ''; ?>
                                    <input type="text" class="form-control" name="km_charge" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price/Minute</label><i class="text-danger asterik">*</i><?php echo isset($error['minute_charge']) ? $error['minute_charge'] : ''; ?>
                                    <input type="text" class="form-control" name="minute_charge" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label><i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" required>
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
            bike_name: "required",
            brand: "required",
            category:"required",
            location:"required",
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
<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

$sql = "SELECT id, name FROM categories ORDER BY id ASC";
$db->sql($sql);
$res = $db->getResult();

?>
<?php
if (isset($_POST['btnAdd'])) {

        $bike_name = $db->escapeString(($_POST['bike_name']));
        $size = $db->escapeString(($_POST['size']));
        $brand = $db->escapeString(($_POST['brand']));
        $type = $db->escapeString($_POST['type']);
        $warranty = $db->escapeString($_POST['warranty']);
        $amount = $db->escapeString($_POST['amount']);
        $delivery_charges = $db->escapeString($_POST['delivery_charges']);
        $fitting_charges = $db->escapeString($_POST['fitting_charges']);
        $actual_price = $db->escapeString($_POST['actual_price']);
        $final_price = $db->escapeString($_POST['final_price']);

        // get image info
        $menu_image = $db->escapeString($_FILES['battery_image']['name']);
        $image_error = $db->escapeString($_FILES['battery_image']['error']);
        $image_type = $db->escapeString($_FILES['battery_image']['type']);

        // create array variable to handle error
        $error = array();
            // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["battery_image"]["name"]));

        if (empty($bike_name)) {
            $error['bike_name'] = " <span class='label label-danger'>Required!</span>";
        }   
        if (empty($size)) {
            $error['size'] = " <span class='label label-danger'>Required!</span>";
        }   
        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }      
        if (empty($type)) {
            $error['type'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($warranty)) {
            $error['warranty'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($amount)) {
            $error['amount'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($delivery_charges)) {
            $error['delivery_charges'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($fitting_charges)) {
            $error['fitting_charges'] = " <span class='label label-danger'>Required!</span>";
        } 
         if (empty($actual_price)) {
            $error['actual_price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($final_price)) {
            $error['final_price'] = " <span class='label label-danger'>Required!</span>";
        }
       
       if (!empty($brand) && !empty($type) && !empty($warranty) && !empty($amount) && !empty($delivery_charges) && !empty($fitting_charges)&& !empty($actual_price) && !empty($final_price)) 
       {   
            $result = $fn->validate_image($_FILES["battery_image"]);
            // create random image file name
            $string = '0123456789';
            $file = preg_replace("/\s+/", "_", $_FILES['battery_image']['name']);
            $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

            // upload new image
            $upload = move_uploaded_file($_FILES['battery_image']['tmp_name'], 'upload/products/' . $menu_image);

            // insert new data to menu table
            $upload_image = 'upload/products/' . $menu_image;


            $sql_query = "INSERT INTO `batteries` (bike_name,size,brand,type,warranty,amount,delivery_charges,fitting_charges,actual_price,final_price,status)VALUES('$bike_name','$size','$brand','$type','$warranty','$amount','$delivery_charges','$fitting_charges','$actual_price','$final_price',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_battery'] = "<section class='content-header'>
                                                <span class='label label-success'>Battery Added Successfully</span> </section>";
            } else {
                $error['add_battery'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Battery <small><a href='batteries.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Batteries</a></small></h1>

    <?php echo isset($error['add_battery']) ? $error['add_battery'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-8">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_battery_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                   <div class="col-md-6">
                                        <label for="exampleInputEmail1">Bike Name</label><i class="text-danger asterik">*</i><?php echo isset($error['bike_name']) ? $error['bike_name'] : ''; ?>
                                        <input type="text" class="form-control" name="bike_name" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                   <div class="col-md-4">
                                        <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i><?php echo isset($error['brand']) ? $error['brand'] : ''; ?>
                                        <input type="text" class="form-control" name="brand" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Type</label> <i class="text-danger asterik">*</i>
										<select id="type" name="type" class="form-control">
										    <option value="">select</option>
											<option value="Self start">Self start</option>
											<option value="Non-Self start">Non-Self start</option>
										</select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Size</label><i class="text-danger asterik">*</i><?php echo isset($error['size']) ? $error['size'] : ''; ?>
                                        <input type="text" class="form-control" name="size" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">warranty</label><i class="text-danger asterik">*</i><?php echo isset($error['warranty']) ? $error['warranty'] : ''; ?>
                                        <input type="number" class="form-control" name="warranty" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Amount</label><i class="text-danger asterik">*</i><?php echo isset($error['amount']) ? $error['amount'] : ''; ?>
                                        <input type="number" class="form-control" name="amount" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1">Delivery Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['delivery_charges']) ? $error['delivery_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="delivery_charges" required>
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Fitting Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['fitting_charges']) ? $error['fitting_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="fitting_charges" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                     <div class="col-md-6">
                                        <label for="exampleInputEmail1">Actual Price</label><i class="text-danger asterik">*</i><?php echo isset($error['actual_price']) ? $error['actual_price'] : ''; ?>
                                        <input type="number" class="form-control" name="actual_price" required>
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Final Price</label><i class="text-danger asterik">*</i><?php echo isset($error['final_price']) ? $error['final_price'] : ''; ?>
                                        <input type="number" class="form-control" name="final_price" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                        <label for="exampleInputFile">Image</label> <i class="text-danger asterik">*</i><?php echo isset($error['battery_image']) ? $error['battery_image'] : ''; ?>
                                        <input type="file" name="battery_image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="battery_image"/>
                                        <img id="blah" src="#" alt="" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                    </div>

                </form>

            </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_battery_form').validate({

        ignore: [],
        debug: false,
        rules: {
            brand: "required",
            warranty: "required",
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

<!--code for page clear-->
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>
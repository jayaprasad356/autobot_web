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
        $brand = $db->escapeString(($_POST['brand']));
        $size = $db->escapeString($_POST['size']);
        $wheel = $db->escapeString($_POST['wheel']);
        $pattern = $db->escapeString($_POST['pattern']);
        $tyre_type = $db->escapeString($_POST['tyre_type']);
        $amount = $db->escapeString($_POST['amount']);
        $delivery_charges = $db->escapeString($_POST['delivery_charges']);
        $fitting_charges = $db->escapeString($_POST['fitting_charges']);
        $actual_price = $db->escapeString($_POST['actual_price']);
        $final_price = $db->escapeString($_POST['final_price']);

         // get image info
         $menu_image = $db->escapeString($_FILES['tyre_image']['name']);
         $image_error = $db->escapeString($_FILES['tyre_image']['error']);
         $image_type = $db->escapeString($_FILES['tyre_image']['type']);
 
         // create array variable to handle error
         $error = array();
             // common image file extensions
         $allowedExts = array("gif", "jpeg", "jpg", "png");
 
         // get image file extension
         error_reporting(E_ERROR | E_PARSE);
         $extension = end(explode(".", $_FILES["tyre_image"]["name"]));

         if (empty($bike_name)) {
            $error['bike_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($size)) {
            $error['size'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($wheel)) {
            $error['wheel'] = " <span class='label label-danger'>Required!</span>";
        } 
         if (empty($pattern)) {
            $error['pattern'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($tyre_type)) {
            $error['tyre_type'] = " <span class='label label-danger'>Required!</span>";
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
       
       if (!empty($brand) && !empty($size) && !empty($wheel)&& !empty($pattern)&& !empty($tyre_type)&&!empty($amount) && !empty($delivery_charges) && !empty($fitting_charges)&& !empty($actual_price)&& !empty($final_price)) 
       {   
                $result = $fn->validate_image($_FILES["tyre_image"]);
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['tyre_image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

                // upload new image
                $upload = move_uploaded_file($_FILES['tyre_image']['tmp_name'], 'upload/images/' . $menu_image);

                // insert new data to menu table
                $upload_image = 'upload/images/' . $menu_image;

           
            $sql_query = "INSERT INTO tyre_products (bike_name,brand,size,wheel,pattern,tyre_type,amount,delivery_charges,fitting_charges,actual_price,final_price,image,status)VALUES('$bike_name'.'$brand','$size','$wheel','$pattern','$tyre_type','$amount','$delivery_charges','$fitting_charges','$actual_price','$final_price','$upload_image',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_tyre_product'] = "<section class='content-header'>
                                                <span class='label label-success'>Tyre Product Added Successfully</span> </section>";
            } else {
                $error['add_tyre_product'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Tyre Product <small><a href='tyre_products.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Tyre Product</a></small></h1>

    <?php echo isset($error['add_tyre_product']) ? $error['add_tyre_product'] : ''; ?>
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
                <form name="add_tyre_product_form" method="post" enctype="multipart/form-data">
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
                                        <label for="exampleInputEmail1">Size</label><i class="text-danger asterik">*</i><?php echo isset($error['size']) ? $error['size'] : ''; ?>
                                        <input type="number" class="form-control" name="size" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Wheel Type</label><i class="text-danger asterik">*</i><?php echo isset($error['wheel']) ? $error['wheel'] : ''; ?>
                                        <select  name="wheel" id="wheel" class="form-control" required>
                                            <option value="">--select--</option>
                                            <option value="Front tyre">Front tyre</option>
                                            <option value="Rear tyre">Rear tyre</option>
                                        </select>   
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                   <div class="col-md-4">
                                        <label for="exampleInputEmail1">Pattern</label><i class="text-danger asterik">*</i><?php echo isset($error['pattern']) ? $error['pattern'] : ''; ?>
                                        <input type="text" class="form-control" name="pattern" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Tyre Type</label><i class="text-danger asterik">*</i><?php echo isset($error['tyre_type']) ? $error['tyre_type'] : ''; ?>
                                        <select  name="tyre_type" id="tyre_type" class="form-control" required>
                                              <option value="">--select--</option>
                                              <option value="Tube">Tube</option>
                                              <option value="Tubeless">Tubeless</option>
                                        </select>   
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Amount</label><i class="text-danger asterik">*</i><?php echo isset($error['amount']) ? $error['amount'] : ''; ?>
                                        <input type="number" class="form-control" name="amount" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                     <div class="col-md-4">
                                        <label for="exampleInputEmail1">Delivery Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['delivery_charges']) ? $error['delivery_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="delivery_charges" required>
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Fitting Charges</label><i class="text-danger asterik">*</i><?php echo isset($error['fitting_charges']) ? $error['fitting_charges'] : ''; ?>
                                        <input type="number" class="form-control" name="fitting_charges" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                     <div class="col-md-4">
                                        <label for="exampleInputEmail1">Actual Price</label><i class="text-danger asterik">*</i><?php echo isset($error['actual_price']) ? $error['actual_price'] : ''; ?>
                                        <input type="number" class="form-control" name="actual_price" required>
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Final Price</label><i class="text-danger asterik">*</i><?php echo isset($error['final_price']) ? $error['final_price'] : ''; ?>
                                        <input type="number" class="form-control" name="final_price" required>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label> <i class="text-danger asterik">*</i><?php echo isset($error['tyre_image']) ? $error['tyre_image'] : ''; ?>
                                    <input type="file" name="tyre_image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="tyre_image" />
                                </div>
                                <div class="form-group">
                                    <img id="blah" src="#"  />
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
    $('#add_tyre_product_form').validate({

        ignore: [],
        debug: false,
        rules: {
            brand: "required",
            size: "required",
            wheel: "required",
            tyre_type: "required",
            pattern: "required",
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
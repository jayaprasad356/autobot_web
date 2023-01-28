<?php
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

$seller_id = $_SESSION['seller_id'];

?>
<?php
if (isset($_POST['btnAdd'])) {


        $brand = $db->escapeString($_POST['brand']);
        $bike_name = $db->escapeString($_POST['bike_name']);
        $model = $db->escapeString($_POST['model']);
        $km_driven = $db->escapeString($_POST['km_driven']);
        $price = $db->escapeString($_POST['price']);
        $location = $db->escapeString($_POST['location']);
        $color = $db->escapeString($_POST['color']);

        // get image info
        $menu_image = $db->escapeString($_FILES['image']['name']);
        $image_error = $db->escapeString($_FILES['image']['error']);
        $image_type = $db->escapeString($_FILES['image']['type']);

        //image1 info
        $menu_image = $db->escapeString($_FILES['image1']['name']);
        $image_error = $db->escapeString($_FILES['image1']['error']);
        $image_type = $db->escapeString($_FILES['image1']['type']);

        //image2 info
        $menu_image = $db->escapeString($_FILES['image2']['name']);
        $image_error = $db->escapeString($_FILES['image2']['error']);
        $image_type = $db->escapeString($_FILES['image2']['type']);

        //image3 info
        $menu_image = $db->escapeString($_FILES['image3']['name']);
        $image_error = $db->escapeString($_FILES['image3']['error']);
        $image_type = $db->escapeString($_FILES['image3']['type']);

        // create array variable to handle error
        $error = array();
            // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["image"]["name"]));

        //get image1 file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["image1"]["name"]));

        //get image2 file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["image2"]["name"]));
        
        //get image3 file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["image3"]["name"]));
        

        if (empty($brand)) {
            $error['brand'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($bike_name)) {
            $error['bike_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($model)) {
            $error['model'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($km_driven)) {
            $error['km_driven'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($color)) {
            $error['color'] = " <span class='label label-danger'>Required!</span>";
        }


        if (!empty($brand) && !empty($bike_name) && !empty($model) && !empty($km_driven) && !empty($price) && !empty($location)&& !empty($color)) 
        {
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                // upload new image
                $upload = move_uploaded_file($_FILES['image']['tmp_name'], '../upload/vehicles/' . $menu_image);
        
                // insert new data to menu table
                $upload_image = $menu_image;
                $upload_image1 ='';
                $upload_image2 ='';
                $upload_image3 ='';

                //image1 info
                if ($_FILES['image1']['size'] != 0 && $_FILES['image1']['error'] == 0 && !empty($_FILES['image1'])){
                    // create random image1 file name
                    $string = '0123456789';
                    $file = preg_replace("/\s+/", "_", $_FILES['image1']['name']);
                    $image1 = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
    
                    //upload new image1
                    $upload = move_uploaded_file($_FILES['image1']['tmp_name'], '../upload/vehicles/' . $image1);
    
                    // insert new data to menu table
                    $upload_image1 = $image1;
               
                }
                 //image2 info
                if ($_FILES['image2']['size'] != 0 && $_FILES['image2']['error'] == 0 && !empty($_FILES['image2'])){
                    // create random image2 file name
                    $string = '0123456789';
                    $file = preg_replace("/\s+/", "_", $_FILES['image2']['name']);
                    $image2 = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                    //upload new image2
                    $upload = move_uploaded_file($_FILES['image2']['tmp_name'], '../upload/vehicles/' . $image2);
        
                    // insert new data to menu table
                    $upload_image2 = $image2;

                }
                //image3 info
                if ($_FILES['image3']['size'] != 0 && $_FILES['image3']['error'] == 0 && !empty($_FILES['image3'])){
                    // create random image3 file name
                    $string = '0123456789';
                    $file = preg_replace("/\s+/", "_", $_FILES['image3']['name']);
                    $image3 = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                    //upload new image3
                    $upload = move_uploaded_file($_FILES['image3']['tmp_name'], '../upload/vehicles/' . $image3);
        
                    // insert new data to menu table
                    $upload_image3 =$image3;

                }
           
            $sql_query = "INSERT INTO used_vehicles (user_id,brand,bike_name,model,km_driven,price,location,image,image1,image2,image3,color) VALUES ('$seller_id','$brand','$bike_name','$model','$km_driven','$price','$location','$upload_image','$upload_image1','$upload_image2','$upload_image3','$color')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_vehicle'] = " <section class='content-header'><span class='label label-success'>Vehicle Added Successfully</span></section>";
            } else {
                $error['add_vehicle'] = " <span class='label label-danger'>Failed!</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Vehicle <small><a href='used_vehicles.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Vehicles</a></small></h1>

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
                                        <label for="exampleInputEmail1">Brand</label><i class="text-danger asterik">*</i>
                                        <select id='brand' name="brand" class='form-control' required>
                                                <option value="">Select</option>
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
                                    <label for="exampleInputEmail1"> Model</label><i class="text-danger asterik">*</i><?php echo isset($error['model']) ? $error['model'] : ''; ?>
                                    <input type="number" class="form-control" name="model" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> KM Driven</label><i class="text-danger asterik">*</i><?php echo isset($error['km_driven']) ? $error['km_driven'] : ''; ?>
                                    <input type="text" class="form-control" name="km_driven" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                    <input type="text" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label><i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> color</label><i class="text-danger asterik">*</i><?php echo isset($error['color']) ? $error['color'] : ''; ?>
                                    <input type="text" class="form-control" name="color" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                    <label for="exampleInputFile">Image</label><i class="text-danger asterik">*</i><?php echo isset($error['image']) ? $error['image'] : ''; ?>
                                    <input type="file" name="image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="image" />
                                    <div class="form-group">
                                        <img id="blah" src="#" alt="" />
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <label for="exampleInputFile">Image1</label><?php echo isset($error['image1']) ? $error['image1'] : ''; ?>
                                    <input type="file" name="image1" accept="image/png,  image/jpeg" id="image1" />
                                    <div class="form-group">
                                        <img id="blan" src="#" alt="image" />
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <label for="exampleInputFile">Image2</label><?php echo isset($error['image2']) ? $error['image2'] : ''; ?>
                                    <input type="file" name="image2" accept="image/png,  image/jpeg" id="image2"/>
                                    <div class="form-group">
                                        <img id="blas" src="#" alt="image" />
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputFile">Image3</label><?php echo isset($error['image3']) ? $error['image3'] : ''; ?>
                                <input type="file" name="image3" accept="image/png,  image/jpeg" id="image3" />
                                <div class="form-group">
                                    <img id="blan" src="#" alt="image" />
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
            brand: "required",
            model: "required",
            price:"required",
            bike_name:"required",
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
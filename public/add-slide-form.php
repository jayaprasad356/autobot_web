<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {


        $name = $db->escapeString(($_POST['name']));
        $type = $db->escapeString(($_POST['type']));

        // get image info
        $menu_image = $db->escapeString($_FILES['category_image']['name']);
        $image_error = $db->escapeString($_FILES['category_image']['error']);
        $image_type = $db->escapeString($_FILES['category_image']['type']);

        // create array variable to handle error
        $error = array();
            // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["category_image"]["name"]));
        

        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($type)) {
            $error['type'] = " <span class='label label-danger'>Required!</span>";
        }
     
       

      

        if (!empty($name) && !empty($type)) {
            $result = $fn->validate_image($_FILES["category_image"]);
                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['category_image']['name']);
                $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        
                // upload new image
                $upload = move_uploaded_file($_FILES['category_image']['tmp_name'], 'upload/slides/' . $menu_image);
        
                // insert new data to menu table
                $upload_image = 'upload/slides/' . $menu_image;

            
           
            $sql_query = "INSERT INTO slides (name,type,image,status)VALUES('$name','$type','$upload_image',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_slide'] = " <section class='content-header'><span class='label label-success'>Slide Added Successfully</span></section>";
            } else {
                $error['add_slide'] = " <span class='label label-danger'>Failed add slide</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Slide<small><a href='slides.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Slides</a></small></h1>

    <?php echo isset($error['add_slide']) ? $error['add_slide'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Slide</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="add_slide" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Name</label><i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Slider Type</label> <i class="text-danger asterik">*</i>
                            <select id="type" name="type" class="form-control">
                                <option value="">--select--</option>
                                <option value="home_slider">Home Slider</option>
                                <option value="service_slider">Service Slider</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Image</label><i class="text-danger asterik">*</i><?php echo isset($error['category_image']) ? $error['category_image'] : ''; ?>
                            <input type="file" name="category_image" onchange="readURL(this);" accept="image/png,  image/jpeg" id="category_image" />
                        </div>
                        <div class="form-group">
                            <img id="blah" src="#" alt="" />

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
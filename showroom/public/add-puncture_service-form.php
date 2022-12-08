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

        $bike_id = $db->escapeString(($_POST['bike_id']));
        $tyre_type = $db->escapeString($_POST['tyre_type']);
        $wheel = $db->escapeString($_POST['wheel']);
        $price = $db->escapeString($_POST['price']);

        
        if (empty($bike_id)) {
            $error['bike_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($tyre_type)) {
            $error['tyre_type'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($wheel)) {
            $error['wheel'] = " <span class='label label-danger'>Required!</span>";
        } 
         if (empty($price)) {
            $error['price'] = " <span class='label label-danger'>Required!</span>";
        }
       
       if (!empty($bike_id) && !empty($tyre_type) && !empty($wheel)&& !empty($price)) 
       {   
           
            $sql_query = "INSERT INTO puncture_services (bike_id,tyre_type,wheel,price,status)VALUES('$bike_id','$tyre_type','$wheel','$price',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                $error['add_puncture_service'] = "<section class='content-header'>
                                                <span class='label label-success'>Puncture Service Added Successfully</span> </section>";
            } else {
                $error['add_puncture_service'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Bike Puncture Service <small><a href='puncture_services.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Bike Puncture Services</a></small></h1>

    <?php echo isset($error['add_puncture_service']) ? $error['add_puncture_service'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_puncture_service_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for=""> Choose Bike</label> <i class="text-danger asterik">*</i>
                                    <select id='bike_id' name="bike_id" class='form-control' required>
                                        <option value="">-- Select --</option>
                                                <?php
                                                    $sql = "SELECT id,bike_name FROM `bikes`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                ?>
                                                    <option value='<?= $value['id'] ?>'><?= $value['bike_name'] ?></option>
                                            <?php } ?>
                                     </select>
                                </div>
                             </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                    <div class="col-md-4">
                                         <label class="control-label">Tyre Type</label> <i class="text-danger asterik">*</i><br>
                                          <div id="status" class="btn-group">
                                            <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="tyre_type" value="Tube-tyre">Tube Tyre
                                            </label>
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="tyre_type" value="Tubeless-tyre"> Tubeless Tyre
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Wheel</label> <i class="text-danger asterik">*</i>
                                            <select id="wheel" name="wheel" class="form-control">
                                                <option value="">--select--</option>
                                                <option value="Front">Front</option>
                                                <option value="Rear">Rear</option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Price</label><i class="text-danger asterik">*</i><?php echo isset($error['price']) ? $error['price'] : ''; ?>
                                        <input type="number" class="form-control" name="price" required>
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
    $('#add_puncture_service_form').validate({

        ignore: [],
        debug: false,
        rules: {
            bike_id: "required",
            price: "required",
            rear_tube_tyre: "required",
            tyre_type: "required",
            wheel: "required",
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
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>
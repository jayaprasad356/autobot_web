<?php


include('../includes/variables.php');
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_POST['btnLogin'])) {

    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $password = $db->escapeString($fn->xss_clean($_POST['password']));

    $currentTime = time() + 25200;
    $expired = 3600;

    $error = array();

    if (empty($mobile)) {
        $error['mobile'] = " <span class='label label-danger'>Mobile should be filled!</span>";
    }

    if (empty($password)) {
        $error['password'] = " <span class='label label-danger'>Password should be filled!</span>";
    }

    if (!empty($mobile) && !empty($password)) {
       
        $sql_query = "SELECT * FROM showrooms WHERE mobile = '$mobile' AND password = '$password'";

        $db->sql($sql_query);

        $res = $db->getResult();
        $num = $db->numRows($res);

        if ($num == 1) {
            if($res[0]['status'] == 1){
                $_SESSION['store_name'] = $res[0]['store_name'];
                $_SESSION['id'] = $res[0]['id'];
                $_SESSION['timeout'] = $currentTime + $expired;
                header("location: home.php");
            }
            else{
                $error['failed'] = "<span class='btn btn-danger'>Your account is not activated yet!</span>";
            }
        } else {
            $error['failed'] = "<span class='btn btn-danger'>Invalid Mobile or Password!</span>".$password;
        }
    }
}
?>
<?php echo isset($error['update_user']) ? $error['update_user'] : ''; ?>
<div class="col-md-4 col-md-offset-4 " style="margin-top:150px;">
    <!-- general form elements -->
    <div class='row'>
        <div class="col-md-12 text-center">
            <img src="../dist/img/logo.png" height="110">
            <h3>Showroom-Dashboard</h3>
        </div>
        <div class="box box-info col-md-12">
            <div class="box-header with-border">
                <h3 class="box-title">Showroom Login</h3>
                <center>
                    <div class="msg"><?php echo isset($error['failed']) ? $error['failed'] : ''; ?>
                    <?php echo isset($error['failed_status']) ? $error['failed_status'] : ''; ?></div>
                </center>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile :</label>
                        <input type="number" name="mobile" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password :</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="btnLogin" class="btn btn-info pull-left">Login</button>
                    </div>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>
<?php include('../footer.php'); ?>
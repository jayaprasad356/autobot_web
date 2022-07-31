<?php


if (isset($_POST['btnLogin'])) {

    $mobile = $db->escapeString($_POST['mobile']);
    $password = $db->escapeString($_POST['password']);

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

        $sql_query = "SELECT * FROM mechanic WHERE mobile = '" . $mobile . "' AND password = '" . $password . "'";

        $db->sql($sql_query);

        $res = $db->getResult();
        $num = $db->numRows($res);

        if ($num == 1) {
            $_SESSION['id'] = '1';
            $_SESSION['role'] ='admin';
            $_SESSION['username'] = 'username';
            $_SESSION['email'] = 'admin@gmail.com';
            $_SESSION['timeout'] = $currentTime + $expired;

            $_SESSION['mechanic_id'] = $res[0]['id'];
            $_SESSION['mechanic_name'] = $res[0]['name'];
            header("location: home.php");
            
        } else {
            $error['failed'] = "<span class='btn btn-danger'>Invalid Mobile or Password!</span>";
        }
    }


        
    }
?>
<div class="col-md-4 col-md-offset-4 " style="margin-top:80px;">
    <div class='row'>
        <div class="col-md-12 text-center">
            <img src="../dist/img/logo.png" height="110">
            
        </div>
        
        <div class="box box-info col-md-12 ">
            <div class="box-header with-border ">
                <h3 class="box-title">Mechanic Login</h3>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile :</label><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                        <input type="text" name="mobile" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password :</label><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                        <input type="text" class="form-control" name="password" value=""><br>
                    </div>
                    <center><?php echo isset($error['failed']) ? $error['failed'] : ''; ?></center>
                    <center><?php echo isset($error['failed_status']) ? $error['failed_status'] : ''; ?></center>
                    <div class="box-footer">
                        <button type="submit" name="btnLogin" class="btn btn-info pull-left">Login</button>
                    </div>
                    <div class="box-footer">
                        <a href="sign-up.php" class="btn pull-left">Create Mechanic Account?</a>
                        <!-- <a href="forgot-password.php" class="btn pull-right">Forgot password?</a> -->

                    </div>
                
                   
            </form>
        </div>
    </div>
</div>
</div>

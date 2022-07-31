
<?php session_start();

include_once('../includes/custom-functions.php');

$function = new custom_functions;

// set time for session timeout
$currentTime = time() + 25200;
$expired = 900;

if (!isset($_SESSION['mechanic_id']) && !isset($_SESSION['mechanic_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['mechanic_id'];
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}
// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;



include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Autobot Mechanic</title>
</head>
<body>

    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Home</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php"> <i class="fa fa-home"></i> Home</a>
                </li>
            </ol>

        </section>
        <section class="content">
            <div class="row">
                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php
                            $sql = "SELECT * FROM services";
                            $db->sql($sql);
                            $res = $db->getResult();
                            $num = $db->numRows($res);
                            echo $num;
                             ?></h3>
                            <p>Services</p>
                        </div>
                        <div class="icon"><i class="fa fa-wrentch"></i></div>
                        <a href="services.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
               

            </div>
            
        </section>
        
    </div>

    <?php include "footer.php"; ?>
    
</body>
</html>
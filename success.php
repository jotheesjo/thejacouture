<?php session_start();
include('db.php'); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Theja Courture - Order Success</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
    <div class="wrapper" id="wrapper">
    <?php include('header.php');?>

            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs" style="padding:5% 20px;">
                    <div class="container">
                        <div class="parallax__layer ">
                            <h3 style="font-size:28px;" class="text-center">Your Order Placed Successfully!<br/> Your order id is:<?=$_GET['ordid'];?><br/><br/></h3>
                            <h4 class="text-center">Check your inbox or spam mail and SMS to know your order detail</h4>
                               

                            <img src="images/order_successful.png" class="img-responsive" style="display: block;margin: 0 auto;max-width: 300px;"/>
                            <p><a class="btn btn-primary" href="index.php">Back to Home</a></p>
                        </div>
                         
                    </div>
                </section>

</div>
            </div>
<?php include('footer.php');?>
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
        </body>
    </html>
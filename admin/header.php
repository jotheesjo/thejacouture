<?php include("init.php"); ?> 
<!doctype html>
<html lang="en">
<head>
    <title>Dashboard | Theja Courture</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.thejacouture.in/images/favicon.png">
    <link rel="shortcut icon" href="https://www.thejacouture.com/images/favicon.png">
    <style>
    #product_value{
        display:none;
    }
    </style>
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
<!-- Dashboard -->
<?php
$overallproducts=$db->queryUniqueObject("SELECT count(*) as overallproducts from products");
$overallproducts = $overallproducts->overallproducts;
$overalluser=$db->queryUniqueObject("SELECT count(*) as overalluser from customer");
$overalluser = $overalluser->overalluser;
$overallorder=$db->queryUniqueObject("SELECT count(*) as overallorder from orders");
$overallorder = $overallorder->overallorder;
$overallsales=$db->queryUniqueObject("SELECT SUM(grant_total) as overallsales from orders WHERE order_status!='cancelled'");
$overallsales = $overallsales->overallsales;
// ?>
 <!-- Notification -->
  <?php
 $review=$db->queryUniqueObject("SELECT count(*) as review from product_review WHERE notification='1'");
 $totreview = $review->review;
// $serviceorder=$db->queryUniqueObject("SELECT count(*) as serviceorder from service_order WHERE notification='1'");
// $totserviceorder = $serviceorder->serviceorder; 
 $productorders=$db->queryUniqueObject("SELECT count(*) as productorders from orders WHERE notification='1'");
 $totproductorders = $productorders->productorders; 

// //over all notification
 $allnotification=$totreview+$productorders ;

?>
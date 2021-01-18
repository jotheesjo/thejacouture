<?php session_start(); 
include('db.php');
if((isset($_SESSION['user_id'])) && ($_SESSION['user_type']=='guest')){   header("Location: login.php"); exit; }?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Order History</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
     <?php include('header.php');?>

     <section class="wn__recent__post pt--50  pb--30">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <a href="order-history.php"><div class="post__itam orderic">
                        <div class="content">
                            <img src="images/order_icon.svg" class="img-fluid"/>
                            <h3>Your Orders</h3>
                        </div>
                    </div></a>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <a href="address-book.php">
                        <div class="post__itam orderic">
                            <div class="content">
                                <img src="images/location_icon.svg" class="img-fluid"/>
                                <h3>Addresses</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <a href="change-password.php"><div class="post__itam orderic">
                        <div class="content">
                            <img src="images/security_icon.svg" class="img-fluid"/>
                            <h3>Settings</h3>
                        </div>
                    </div></a>
                </div>




            </div>
        </div>
    </section>

    <div class="cart-main-area  pt--50  pb--30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <h3>Orders </h3> 

                    <form action="#">               
                        <div class="table-content wnro__table table-responsive">
                            <table>
                                <thead>
                                    <tr class="title-top">
                                        <th class="product-thumbnail">Order Id</th>
                                        <th class="product-price">Order Date</th>
                                        <th class="product-quantity">Status</th>
                                        <th class="product-quantity">Amount</th>
                                        <th class="product-quantity">Shipping Cost</th>
                                        <th class="product-quantity">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $qryord=mysqli_query($conn,"SELECT * FROM orders WHERE  user_id='$_SESSION[user_id]' AND order_status!='failed' AND payment_status!='failed' AND payment_status!='' ORDER BY id DESC"); 
                                    while($feth_ord=mysqli_fetch_array($qryord)){
                                        ?>
                                        <tr>
                                            <td class="product-name"><a href="order_details.php?ord_id=<?php echo $feth_ord['order_id']; ?>"><?php echo  $feth_ord['order_id']; ?></a></td>
                                            <td class="product-price"><span class="amount"><?php echo date("d-m-Y", strtotime($feth_ord['date']));   ?></span></td>
                                            <td class="product-name"><a href="#"><?php echo $feth_ord['order_status']; ?></a></td>
                                            <td class="product-subtotal"><?php echo $feth_ord['total_price']; ?></td>
                                            <td class="product-subtotal"><?php echo $feth_ord['ship_cost']; ?></td>
                                            <td class="product-subtotal"><?php echo $feth_ord['grant_total']; ?></td>
                                            
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form> 

                </div>
            </div>

        </div>  
    </div>


    <?php include('footer.php');?>
</div>

<!-- JS Files -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>
<script>
    $(".search_active").click(function(){
      $(".search").toggle();
  });
</script>
</body>
</html>
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
                    <th class="product-price">Product image</th>
                    <th class="product-price">Product Name</th>
                    <th class="product-quantity">Qty</th>
                    <th class="product-quantity">Amount</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $qryord=mysqli_query($conn,"SELECT * FROM orders WHERE  order_id='$_GET[ord_id]'"); 
                  $feth_ord=mysqli_fetch_array($qryord);
                  $prod=json_decode($feth_ord['order_detail']);
                  for($i=0;$i<count($prod);$i++){ 
                    $prod_id=$prod[$i]->product_id;
                    $product=mysqli_fetch_array(mysqli_query($conn,"SELECT img_path FROM products WHERE product_id='$prod_id'"));
                    $img=json_decode($product['img_path']);
$pr_in=mysqli_fetch_assoc(mysqli_query($conn, "SELECT color,size FROM products WHERE product_id='$prod_id'"));
$cart_color=mysqli_fetch_assoc(mysqli_query($conn, "SELECT color_name FROM variation_color WHERE color_id='$pr_in[color]'"));
$cart_size=mysqli_fetch_assoc(mysqli_query($conn, "SELECT size_name FROM variation_size WHERE size_id='$pr_in[size]'"));
                     ?>

                    <tr>
                      <td class="product-price"><?=$feth_ord['order_id'];?></td>
                      <td class="product-name"><img src="<?php echo $img[0]; ?>" height="24%"></td>
                      <td class="product-name"><?=$prod[$i]->name;?> <br/>
                        Color:<?=$cart_color['color_name'];?>
                      </td>
                      <td class="product-price"><?=$prod[$i]->qty;?></td>
                  
                      <td class="product-price">₹<?=$prod[$i]->price;?></td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
                        </div>
                    </form> 

                </div>
                
             <div class="col-md-12 col-sm-12 ol-lg-12">
                 <h3>Shipping Address </h3>
                 <?php $shippaddr=json_decode($feth_ord['shipping_address'],true); 
                 echo $shippaddr['sname'].', <br/>'.$shippaddr['semail'].', <br/>'.$shippaddr['smobile'].', <br/>'.$shippaddr['saltr_mobile'].', <br/>'.$shippaddr['saddr1'].', <br/>'.$shippaddr['saddr2'].', <br/>'.$shippaddr['saddr3'].', <br/>'.$shippaddr['scity'].', <br/>'.$shippaddr['sstate'].', <br/>'.$shippaddr['scountry'].', <br/>'.$shippaddr['spincode'];
                 ?>
                 
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
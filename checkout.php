<?php session_start();
include('db.php');

if((!isset($_SESSION['cart'])) || (empty($_SESSION['cart']))){   header("Location: index.php"); exit; }
 $msg='';
if((isset($_POST['email_login'])) && (isset($_POST['pwd_login']))){
    $email = $_POST['email_login'];
    $con_pwd = md5($_POST['pwd_login']);
    $sql = "SELECT * FROM customer WHERE email='$email' and pwd='$con_pwd'";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);
    if($count==1){

       $check=mysqli_fetch_array($result);
       if($check['status']==0){
          $msg = "Your account was disabled contact administrator";
        
    }else{
      $_SESSION['user_name']= $check['name'];
        $_SESSION['user_email']= $check['email'];
        $_SESSION['user_id']= $check['customer_id'];
        $_SESSION['user_type']='user';

       $msg='';
    }

    }else {
        $msg = "Your username or password is incorrect";
        
    }

}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Theja couture - Checkout</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php'); ?>
</head>
<body>
    <div class="wrapper" id="wrapper">
<?php include('header.php');
//print_r($_SESSION);
?>
        <!-- Start Checkout Area -->
        <section class="wn__checkout__area section-padding--lg bg__white">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wn_checkout_wrap">
                            <?php if($_SESSION['user_type']!='user'){ ?>
                                <?php echo $msg; ?>
                            <div class="checkout_info">
                                <span>Returning customer ?</span>
                                <a class="showlogin" href="#">Click here to login</a>
                            </div>
                            <div class="checkout_login">
                                <form class="wn__checkout__form" id="odr_login" action="checkout.php" method="POST">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
                                    <div class="input__box">
                                        <label>Email <span>*</span></label>
                                        <input type="text" name="email_login" id="ord_e_login">
                                    </div>

                                    <div class="input__box">
                                        <label>password <span>*</span></label>
                                        <input type="password" name="pwd_login"  id="ord_p_login">
                                    </div>
                                    <div class="form__btn">
                                        <button type="submit" >Login</button>
                                        <a href="login.php" class="btn btn-default" >Signup</a>
                                        <!-- <label class="label-for-checkbox">
                                            <input id="rememberme" name="rememberme" value="forever" type="checkbox">
                                            <span>Remember me</span>
                                        </label> -->
                                        
                                    </div>
                                    </form>
                                
                            </div>
                        <?php } ?>
                            
                        </div>
                    </div>
                </div>
                <form class="checkout-form" id="placeorder" action="orderprocess.php" method="POST">
                    <div class="checkout_info">
                                <span>Have a coupon? </span>
                                <a class="showcoupon" href="#">Click here to enter your code</a>
                            </div>
                            <div class="checkout_coupon">
                                    <div class="form__coupon">
                                        <input type="text" placeholder="Coupon code" id="coupon_text" name="coupon_code">
                                        <input type="button" id="valid_coupon" class="btn btn-primary" value="Apply coupon">
                                        <div id="coupon-info"></div>
                                    </div>
                            </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="customer_details">
                            <h3>Billing details</h3>
                            <div class="customar__field contact-form-wrap">


<?php if($_SESSION['user_type']=='user'){ ?>
<?php $addr_query=mysqli_query($conn, "SELECT * FROM customer_address WHERE customer_id='$_SESSION[user_id]'");
$addr_count=mysqli_num_rows($addr_query); if($addr_count>0){ ?>


 

<div class="input_box">
    <label>Choose Address<span>*</span></label>
    <select class="select__option" id="exist_address">
        <option value=''>Select a address</option>
        <?php while($addr_row=mysqli_fetch_array($addr_query)){ ?>
        <option value="<?=$addr_row['address_id'];?>"><?=$addr_row['name'].', '.$addr_row['addr1'].', '.$addr_row['addr2'].', '.$addr_row['addr3'].', '.$addr_row['city'].', '.$addr_row['state'].', '.$addr_row['country']." - ".$addr_row['zip'];?></option>
        <?php } ?>
    </select>
</div>


<?php }?>
<?php } ?>
                        
                            
                        


                                <div class="single-contact-form space-between">
                                    <input type="text" name="name" placeholder="Full Name*" id="name" required>
                                    <input type="email" name="email" placeholder="Email*" id="email" required>
                                   
                                </div>
                                 <div class="single-contact-form space-between">
                                     <input type="text" name="mobile" placeholder="Mobile Number*" id="mobile" required pattern="\d*">
                                      <input type="text" name="altr_mobile" placeholder="Alternate Mobile Number*" id="altr_mobile" required pattern="\d*">
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr1" placeholder="Flat, House no., Building, Company, Apartment*" id="addr1" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr2" placeholder="Area, Colony, Street, Sector, Village*" id="addr2" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="addr3" placeholder="Landmark e.g. near apollo hospital*" id="addr3" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="city" placeholder="City*" id="city" required>
                                </div>
                               <div class="single-contact-form">
                                    <input type="text" name="state" placeholder="State*" id="state" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="country" placeholder="Country*" id="country" required>
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="pincode" placeholder="Pincode*" id="pincode1" required>
                                </div>
                                <div class="single-contact-form">
        <textarea class="form-control" name="shipping_information" placeholder="Order Notes(optional)"></textarea>
    </div>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                        <div class="wn__order__box">
                            <h3 class="onder__title">Your order</h3>
                            <ul class="order__total">
                                <li>Image</li>
                                <li>Product</li>
                                <li>Total</li>
                            </ul>
                            <ul class="order_product">
                                <?php $grand_total=0;
								$weight=0;
                                        foreach ($_SESSION['cart'] as $key => $value) {
                                            $cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$key'");
                                            while($cart_row= mysqli_fetch_assoc($cart_qry)){
                                                $cart_color=mysqli_fetch_assoc(mysqli_query($conn, "SELECT color_name FROM variation_color WHERE color_id='$cart_row[color]'"));
                                                $cart_size=mysqli_fetch_assoc(mysqli_query($conn, "SELECT size_name FROM variation_size WHERE size_id='$cart_row[size]'"));
                                                ?>
                                                    <?php $imm=json_decode($cart_row['img_path'],true);?>
                                                    <li>
                                                        <img class="img-fluid" src="<?=$imm[0];?>" style="width: 60px;float: left;padding: 0px 15px 0px 0px;"/>
                                                    <?=$cart_row['name'];?> <br/>Color: <?=$cart_color['color_name'];?> × <?=$value;?><strong><span><?=$sub_tot=$value*$cart_row['final_price'];?>/- INR.</span></strong></li>
                                           <?php $grand_total=$grand_total+$sub_tot;
										   $weight=$weight+($cart_row['weight']*$value);
                                             }
                                            
                                        } ?> 
                            </ul>
                            <ul class="shipping__method" style="display:none;">
                                
                               <li>Shipping 
                                    <ul>
                                        <li>
                                            <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" checked="checked" type="radio">
                                            <label><span id="ship"></span> </label>/- INR 
                                        </li>
                                       <!-- <li>
                                            <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" checked="checked" type="radio">
                                            <label>Flat Rate: $48.00</label>
                                        </li>-->
                                    </ul>
                                </li> 
                            </ul>
                            <ul class="total__amount">
                                <li>Order Total <span>/- INR</span><span id="grant_val"><?=$grand_total;?></span>
</li>
                                <li id="grant_valinfo" style="display:none;">Coupon Applied  
                                    <span id="grant_val1"></span><span>/- INR</span>
                                    <span id="grant_va2"><strike> <?=$grand_total;?>/- INR</strike>&nbsp;&nbsp;&nbsp;</span>
                                    
                                </li>
								 <input type="hidden" id="ship_cost" name="ship_cost" value="" readonly>
                                <input type="hidden" id="tot_price" name="tot_price" value="<?=$grand_total?>" readonly>
                                 <input type="hidden" id="grant_tot" name="grant_tot" value="<?=$grand_total?>" readonly>
                                 <input type="hidden" id="coupon_percent" name="coupon_percent" value="" readonly>
                                 <input type="hidden" id="weight" name="weight" value="<?=$weight?>" readonly>
                            </ul>
                        </div>
                        <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                           <select class="form-control" name="payment_mode" id="payment_mode">
                            <!-- <option value="1">Cash on Delivery</option> -->
                            <option value="2">Credit/ Debit card/ Net Banking</option>
                           </select>
                           <br/>
                             <button type="submit" class="btn btn-primary" style="float:right">Place Order</button>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        
        </section>
        <!-- End Checkout Area -->
<?php include('footer.php');?>

    </div>
    <!-- //Main wrapper -->

    <!-- JS Files -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
    <script>
        $(document).ready(function(){
         $("#pincode1").keyup(function(){
			 var len=$(this).val().length;
			 var pin=$(this).val();
			
			 if(len==6)
			 {
          // alert($(this).val());
		    $.ajax({
                        type:'POST',
                        url:'shipping.php',
                        data:'d_pin='+pin+'&gt='+<?php echo $grand_total; ?>+'&weight='+<?php echo $weight;?>,
                        success:function(data){
                           // alert(data);
						    var response = $.parseJSON(data);
							$(".shipping__method").show();
							$("#ship").html(response.ship_cost);
							$("#ship_cost").val(response.ship_cost);
							$("#grant_val").html(response.grand_price);
							$("#grant_tot").val(response.grand_price);
							//$("#grant_val").val(grant_tot1);
                        }
       });
			 }
         });  
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#exist_address").change(function(){
                var exist_address=$(this).val();
                $.ajax({
                    type:'POST',
                    url:'ajax.php',
                    data: { exist_address:exist_address },
                    success:function(data){
                        //console.log(data);
                        var response = $.parseJSON(data);
                        $("#name").val(response.name);
                        $("#email").val(response.email);
                        $("#mobile").val(response.phone);
                        $("#altr_mobile").val(response.alter_phone);
                        $("#addr1").val(response.addr1);
                        $("#addr2").val(response.addr2);
                        $("#addr3").val(response.addr3);
                        $("#city").val(response.city);
                        $("#state").val(response.state);
                        $("#country").val(response.country);
                        $("#pincode").val(response.zip);
                    }
                });
            });
        });
    </script>
    
<script>
// $(function (){
// $('#placeorder').on('submit', function(e){
//     e.preventDefault();
//     var payment_mode=$("#payment_mode").val();
//      $.ajax({
//         type:'POST',
//         url:'ajax-placeorder.php',
//         data:$('#placeorder').serialize(),
//         success:function(data){
//             var response = $.parseJSON(data);
//          console.log(data);
//             if(response.status=='success'){
//               console.log(data);
//               var link = 'success.php?ord_id='+response.ord_id;
//     window.location.assign(link);
//             }else{
//                 var link = 'confirmpayment.php?order='+data;
//     window.location.assign(link);
//             }
//         }
//     })
   
// });
// });
</script>

<script>
$(document).ready(function(){
        $('.ship_diff').click(function(){

            if($(this).prop("checked") == true){
                  //    alert("hai");
            }
            else if($(this).prop("checked") == false){
               // alert("Checkbox is unchecked.");
            }
        });
    });


</script>
    <script>
$(".search_active").click(function(){
  $(".search").toggle();
});
</script>

<!-- Coupon -->
<script>
                $("#valid_coupon").click(function(){
                    var a=$("#coupon_text").val();
                    var subtotal=$("#tot_price").val();
                    var ship_cost=$("#ship_cost").val();
                    if(a!=''){
                     $.ajax({
                        type:'POST',
                        url:'ajax-cart.php',
                        data:'coupon='+a+'&status=apply_coupon'+'&subtotal='+subtotal+'&ship_cost='+ship_cost,
                        success:function(data){
                            var data = $.parseJSON(data);
                           //console.log(data);
                            if(data.success){
                               // $("#grant_val").html(subtotal);
                                $("#grant_valinfo").show();
								$("#grant_val").html(data.success);
                                $("#grant_val1").html(data.coupon_price);
                                $("#coupon-info").show();
                                $("#coupon-info").html(data.msg);
                                $("#valid_coupon").attr("disabled", "disabled");
                                $("#coupon_text").attr("readonly", "readonly");
                                $("#grant_tot").val(data.success);
                                $("#coupon_percent").val(data.coupon_percent);
                            }else{
                                 $("#coupon-info").show();
                                $("#coupon-info").html(data.failure);
                                $("#coupon_percent").val();
                            }
							
                            
                             
                        }

                     });
                    }

});
            </script>
<script>
    
    $("#ord_login").click(function(){
       var email_login=$("#email_login").val();
       var pwd_login=$("#pwd_login").val();
       $.ajax({
                        type:'POST',
                        url:'ajax.php',
                        data:'email_login='+email_login+'&pwd_login='+pwd_login,
                        success:function(data){
                            //alert(data);
                        }
       });
    });
</script>

</body>
</html>
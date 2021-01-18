<?php session_start();
include('db.php');?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Cart</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php'); ?>
</head>
<body>
	<div class="wrapper" id="wrapper">
<?php include('header.php'); ?>
      

<?php if($cart_count>=1){ ?>

	  <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                       
                        <form action="#">               
                            <div class="table-content wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    	<?php $grand_total=0;
                                    	foreach ($_SESSION['cart'] as $key => $value) {
                                    		$cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$key'");
                                    		while($cart_row= mysqli_fetch_assoc($cart_qry)){
                                                //print_R($cart_row['color']);
                                                $cart_color=mysqli_fetch_assoc(mysqli_query($conn, "SELECT color_name FROM variation_color WHERE color_id='$cart_row[color]'"));
                                                $cart_size=mysqli_fetch_assoc(mysqli_query($conn, "SELECT size_name FROM variation_size WHERE size_id='$cart_row[size]'"));
                                                ?>

                                    			<tr>
                                            <td class="product-thumbnail"><a href="product-details.php?<?=md5('prurl');?>=<?=$cart_row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($cart_row['product_id']);?>"><img src="<?php echo json_decode($cart_row['img_path'])[0]; ?>" alt="product img"></a></td>
                                            <td class="product-name"><a href="product-details.php?<?=md5('prurl');?>=<?=$cart_row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($cart_row['product_id']);?>"><?=$cart_row['name'];?><br/>Color: <?=$cart_color['color_name'];?></a></td>
                                            <td class="product-price">
        									<?php if($cart_row['offer']>0){ ?>
        										<span class="amount"><?=$cart_row['final_price'];?>/- INR</span>&nbsp;&nbsp;&nbsp;
        										<span class="amount"><strike><?=$cart_row['price'];?>/- INR</strike></span>
        									<?php }else{ ?>
        										<span class="amount"><?=$cart_row['final_price'];?>/- INR</span>

        									<?php } ?>
        								</td>
                                            <td class="product-quantity"><input type="number" class="qty_inc_box" value="<?=$value;?>" id="qty_<?=$cart_row['product_id'];?>"></td>
                                            <td class="product-subtotal"><?php $sub_tot=$value*$cart_row['final_price']; ?>
                                            <span id="amount_<?=$cart_row['product_id'];?>"><?php echo $sub_tot;?></span>/- INR
                                            	<?php $grand_total=$grand_total+$sub_tot;?>
                                            </td>
                                            
                                            <td class="product-remove">
                                            	<button class="btn btn-danger delete" id='del_<?=$key;?>' data-id='<?=$key;?>'>X</button>
                                            </td>
                                        </tr>

                                    		<?php }
                                    		
                                    	} ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                          
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span><?php echo ' <span id="grand_price">'.$grand_total;?>/- INR</span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                                    <a href="checkout.php" class="btn btn-primary" style="float:right">Checkout</a>
                        </div>
                    </div>
                </div>

                        </form> 
                    </div>
                </div>
                
            </div>  
        </div>
        <!-- cart-main-area end -->

<?php }else{ ?>
<img src="images/empty_cart.png" class="img-fluid" style="display:block;margin:0 auto;">
<?php } ?>

<?php include('footer.php');?>

	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	<script src="js/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function(){

  // Delete 
  $('.delete').click(function(){
    var el = this;
  
    // Delete id
    var deleteid = $(this).data('id');
    // Confirm box
    bootbox.confirm("<h4>Do you really want to remove from cart?</h4>", function(result) {
 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'ajax.php',
           type: 'POST',
           data: { cart_delete:deleteid },
           success: function(response){
// console.log(response);
var parsedJson = $.parseJSON(response);
// console.log(parsedJson.res);
             if(parsedJson.res == 1){
    $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
       $(this).remove();
    });
       }else{
    bootbox.alert('Record not deleted.');
       }
$("#grand_price").html(parsedJson.grant);
           }
         });
       }
 
    });
 
  });
});
</script>
<script>
    $(".qty_inc_box").change(function(){
        var id=$(this).attr("id");
        var myid=id.split('_');
        var upcart=myid[1];
        var quantity=$('#'+id).val();

        $.ajax({
    type:'POST',
    url:'ajax.php',
    data:'upcart='+upcart+"& quantity="+quantity,
    success:function(data){
        //$('#cartcount').html(data);
        var parsedJson = $.parseJSON(data);
        // console.log(parsedJson.single_price);
        $("#amount_"+upcart).html(parsedJson.single_price);
        $("#grand_price").html(parsedJson.grand_price);
         toastr.options = {
                            "debug": false,
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                        }
                        toastr.success("Cart updated");
    }

 });


    });
</script>
    <script>
$(".search_active").click(function(){
  $(".search").toggle();
});
</script>
</body>
</html>
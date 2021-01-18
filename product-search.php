<?php session_start();
include('db.php');
// sort
if(isset($_GET['sort'])){
    if($_GET['sort']=='ltoh'){
        $sort_qry='ORDER BY final_price ASC'; 
    }else if($_GET['sort']=='htol'){
       $sort_qry='ORDER BY final_price DESC';  
   }else if($_GET['sort']=='default'){
    $sort_qry=' '; 
   }
}else{
$sort_qry=' '; 
}
//$query=mysqli_query($conn, "SELECT * FROM products WHERE status='1' ".$type_qry." ".$brand_qry." ".$size_qry." ".$color_qry." ".$price_qry." ".$sort_qry);
$search=$_GET['search'];
$query=mysqli_query($conn, "SELECT * FROM products WHERE status='1' AND name LIKE '%$search%'"." ".$sort_qry);
$count_prod=mysqli_num_rows($query);?>
<!doctype html>

<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>

        <!-- Start Shop Page -->
        <div class="page-shop-sidebar left--sidebar section-padding--lg">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12 col-12 order-1 order-lg-2">
                        <?php if($count_prod>0){ ?>

                        
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									
			                        <p>Total products: <?=$count_prod;?></p>
			                        <div class="orderby__wrapper">
			                        	<span>Sort By</span>
			                        	<select class="shot__byselect" name="sort" onChange="this.form.submit()">
			                        		<option value="default" >Default sorting</option>
			                        		<option value="ltoh"  <?php if(isset($_GET['sort']) && ($_GET['sort']=='ltoh')){ echo " selected";}?>>Price Low to High</option>
			                        		<option value="htol"  <?php if(isset($_GET['sort']) && ($_GET['sort']=='htol')){ echo " selected";}?>>Price High to Low</option>
			                        	</select>
			                        </div>
		                        </div>
        					</div>
        				</div>
                        </form>
        				<div class="tab__container">
	        				<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
	        					<div class="row">
                                    <?php while($row=mysqli_fetch_assoc($query)){ ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="product product-main">
                                            <div class="product__thumb">
                                                <a class="first__img" href="product-details.php?<?=md5('prurl');?>=<?=$row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($row['product_id']);?>">
                                                <?php  $img_data=json_decode($row['img_path']) ?>
                                                <img src="<?php echo $img_data[0];?>" alt="product image"></a>
                                            </div>
                                            <div class="product__content">
                                                <h4><a href="product-details.php?<?=md5('prurl');?>=<?=$row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($row['product_id']);?>"><?=$row['name'];?></a></h4>
                                                
                                                <div class="price-box">
                                                    <span class="regular-price" id="product-price-2">
                                                        
                                                         <span class="price"><?=$row['final_price'];?>/- INR</span>
                                                          <?php if($row['offer']!='' && $row['offer']!='0'){ ?>
                                                    <span class="price old_prize"><strike> <?=$row['price'];?>/- INR</strike></span>
                                                    <?php } ?>
                                                    </span>

                                                </div>

                                                
                                            </div>
                                            <div class="addtocart__actions">
                                    <input type="hidden" value="<?=$row['product_id'];?>" id="prid_<?=$row['product_id'];?>" name="product_id"/>
                                    <input class="form-control qty" type="hidden" name="quantity" value="1" id="qty_<?=$row['product_id'];?>">
									 <?php if($row['qty']>0){ ?>
                                    <button class="tocart" type="submit" id="cart_<?=$row['product_id'];?>">Add to Cart</button>
									 <?php }else{?>
									  <button class="tocart" type="submit" >Out Of Stock</button>
									 <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                     <?php } ?>
	        						
	        					</div>
	        				</div>
        				</div>
                    <?php }else{ ?>
                        <img src="images/empty_cart.png" class="img-fluid" style="display:block;margin:0 auto;">
                    <?php } ?>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- End Shop Page -->
		
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

$(".tocart").click(function(){
    var str=$(this).attr('id');
    var res = str.split("_");
 var quantity=($("#qty_"+res[1]).val());
 var prodid=res[1];
 $.ajax({
    type:'POST',
    url:'ajax-cart.php',
    data:'prid='+prodid+"& quantity="+quantity,
    success:function(data){
        $('#cartcount').html(data);
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
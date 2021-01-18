<?php
session_start();
include('db.php');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Theja Couture</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<?php include('header.php');?>
		 <link rel="stylesheet" href="css/owl.carousel.min.css">
<style>
#owl-demo .item{
  margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
}
  .owl-prev, .owl-next {
	  opacity:0px !important;
	  margin:0px !important;
	   background: none !important;
        width: 15px;
        height: 100px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: block !important;
        border:0px solid black;
    }
    .owl-prev { left: -20px; }
    .owl-next { right: -20px; }
    .owl-prev i, .owl-next i {transform : scale(2,5); color: #ecd287;}
	.owl-prev i:hover, .owl-next i:hover {transform : scale(2,5); color: #ccc;}
</style>
		<?php /*$qry=mysqli_query($conn,"SELECT * FROM banner WHERE status='1'");
		$count_qry=mysqli_num_rows($qry);

		if($count_qry>0){ ?>

			<div id="demo" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ul class="carousel-indicators">
					<?php for($i=0;$i<$count_qry;$i++){ ?>
						<li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){ echo "active";}?>"></li>

					<?php } ?>
				</ul>

				<div class="carousel-inner">
					<?php $bc=0;
					while($banner_row=mysqli_fetch_assoc($qry)){ $bc++;
//print_r($banner_row);?>

<div class="carousel-item <?php if($bc=='1'){ echo " active";}?>">
	<img src="<?=$banner_row['path'];?>" alt="Theja Couture" style="width:100%;">
</div>
<?php } ?>
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#demo" data-slide="prev">
	<span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
	<span class="carousel-control-next-icon"></span>
</a>

</div>

<?php } */?>




<section class="wn__product__area brown--color pt--80  pb--30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section__title text-center">
					<img src="images/polygon.png" class="img-fluid"/>
					<br/>
					<h2 class="title__be--2"><span>WELCOME TO THEJA COUTURE</span></h2>
					<p>Theja couture is an online design store for women’s saree. Costume Designer Theja sree founder of the label Theja couture. “Theja ” is synonymous with brightness.  We are here to bring brightness and grace In every women through saree.</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="wn__product__area brown--color pt--80  pb--30" style="">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="wrapper_title">
					<h4>Newest Arrivals</h4>
					<div class="wrapline"></div>
				</div>

				<?php $qry_new_pr=mysqli_query($conn,"SELECT * FROM products order by added_date desc LIMIT 4"); ?>






				<div class="border--round arrows_style row mt--50">
					<?php while($new_product=mysqli_fetch_array($qry_new_pr)){ 
						$img=json_decode($new_product['img_path']);
						?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-12">
							<div class="product">
								<div class="product__thumb">
									<a class="first__img" href="product-details.php?<?=md5('prurl');?>=<?=$new_product['url'];?>&<?=md5('product_id');?>=<?=base64_encode($new_product['product_id']);?>"><img src="<?php echo $img[0]; ?>" alt="product image"></a>
									<ul class="prize position__right__bottom d-flex">
										<li><?php echo $new_product['final_price']; ?>/- INR</li>
										 <?php if($new_product['offer']!='' && $new_product['offer']!='0'){ ?>
                                                     <li>   <span class="price old_prize">&nbsp;<strike> <?=$new_product['price'];?>/- INR</strike></span></li>
                                                        <?php } ?>

									</ul>
								</div>
								<div class="product__content">
									<h4><a href="product-details.php?<?=md5('prurl');?>=<?=$new_product['url'];?>&<?=md5('product_id');?>=<?=base64_encode($new_product['product_id']);?>" ><?php echo $new_product['name'];  ?></a></h4>


								</div>
								 <?php if($new_product['qty']>0){ ?>
								<div class="addtocart__actions">
									<button class="tocart" type="submit" title="Add to Cart" id="cart_<?=$new_product['product_id'];?>">Add to Cart</button>
								</div>
								 <?php }else{ ?>
								 <div class="addtocart__actions">
									<button class="tocart" type="submit" title="Add to Cart" >Out of Stock</button>
								</div>
								 <?php } ?>
							</div>
						</div>
					<?php } ?>
		





				</div>	
			</div>
		</div>
</div>
</section>

<section class="wn__product__area brown--color pt--80  pb--30" style="">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php $qrycat=mysqli_query($conn,"SELECT * FROM  category WHERE status='active'"); ?>

				<div class="wrapper_title">
					<h4>Top Categories</h4>
					<div class="wrapline"></div>
				</div>
<!--
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
					<?php //while ($fetch_cat=mysqli_fetch_array($qrycat)) {
						?>
						<div class="product product__style--3">
							<div class="col-lg-3 col-md-4 col-sm-6 col-12">
								<div class="product__thumb">
									<a class="first__img" href="products.php?cat=<?php //echo $fetch_cat['cat_name'];?>" target="_blank"><img src="<?php //echo $fetch_cat['path']  ?>" alt="product image">
										<br/> <p class="text-center"><?php //echo $fetch_cat['cat_name'];  ?></p></a>
									</div>
								</div>
							</div>
						<?php //} ?>
					</div>
-->
 <div class="row">
                <?php while ($fetch_cat=mysqli_fetch_array($qrycat)) {
						?>
							<div class="col-md-3">
								<div class="product__thumb pb--30">
									<a class="first__img" href="products.php?cat=<?php echo $fetch_cat['cat_name'];?>" target="_blank"><img src="<?php echo $fetch_cat['path']  ?>" alt="product image">
										<br/> <h6 class="text-center" style="color:#000"><?php echo $fetch_cat['cat_name'];  ?></h6></a>
                                    <div class="addtocart__actions">
									<a class="btn btn-primary text-center" style="display: table;margin: 5px auto;" href="products.php?cat=<?php echo $fetch_cat['cat_name'];?>" class="tocart">Explore More</a>
								</div>
									</div>
								</div>
						<?php } ?>
</div>
				</div>
			</div>
		</div>
</section>


<!--
<section class=" brown--color pt--80  pb--30" style="">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="border--round row">
					<div class="collection_list col-xs-12 col-md-4">
						<a  href="products.php" target="_blank">	<img src="images/category/collection1.jpg" class="img-fluid"/></a>
					</div>
					<div class="collection_list col-xs-12 col-md-4">
						<a  href="products.php" target="_blank">	<img src="images/category/collection2.jpg" class="img-fluid"/></a>
					</div>
					<div class="collection_list col-xs-12 col-md-4">
						<a  href="products.php" target="_blank"><img src="images/category/collection3.jpg" class="img-fluid"/></a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
</section>
-->





<!-- Start story Area -->
<section class="wn__newsletter__area pt--80  pb--30">
    <?php $story_query=mysqli_fetch_array(mysqli_query($conn,"SELECT about,about_img FROM policies")); ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<img src="<?=$story_query['about_img'];?>" class="img-fluid">
			</div>
			<div class="col-lg-7 col-md-12 col-12 ptb--150">
				<div class="section__title text-center">
					<img src="images/story_of_theja.png" style="padding-bottom: 30px;"/>
				</div>
				<div class="say__block text-center">
                    <?=$story_query['about'];?>
					<a href="about.php"> Read More </a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End story Area -->

<!--<section class="wn__recent__post pt--80  pb--30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="wrapper_title">
					<h4>Latest Blogs</h4>
					<div class="wrapline"></div>
				</div>
			</div>
		</div>
		<?php 

		$qry_blog=mysqli_query($conn,"SELECT * FROM blog order by time desc limit 3");
		
			?>
			<div class="row mt--50">
				<?php while($blog=mysqli_fetch_array($qry_blog)){ 
$month=date('M',strtotime($blog['time']));
$day=date('d',strtotime($blog['time']));

					?>
				<div class="col-md-6 col-lg-4 col-sm-12">
					<div class="post__itam">
						<div class="content">
							<img src="<?php echo $blog['path']; ?>" class="img-fluid">
							<div class="br_date"><?php echo $day; ?><br/><?php echo $month; ?></div>
							<h3><a href="blog-details.php?id=<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></a></h3>
						</div>
					</div>
				</div>
			<?php } ?>
			
		</div>
	</div>
</section>-->

<!--<section class="wn__recent__post pt--30  pb--30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<img src="images/offer.png" class="img-fluid"/>
			</div>
		</div>

	</div>
</section>-->

<?php $testi_query=mysqli_query($conn,"SELECT * FROM `feedback` WHERE status='1' order by id DESC");
$rows_count=mysqli_num_rows($testi_query);
if($rows_count>0){ ?> 
<section class="wn__testimonial__area pt--80  pb--30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="testimonial__container text-center">
					<div class="tes__img__slide thumb_active">
<!--
						<div class="testimonial__img">
							<span><img src="images/user-icon.png" alt="Theja"></span>
						</div>
						<div class="testimonial__img">
							<span><img src="images/user-icon.png" alt="Theja"></span>
						</div>
						<div class="testimonial__img">
							<span><img src="images/user-icon.png" alt="Theja"></span>
						</div>
						<div class="testimonial__img">
							<span><img src="images/user-icon.png" alt="Theja"></span>
						</div>
-->
					</div>

					<div class="testimonial__text__slide testext_active">	
                        <?php while($test_row=mysqli_fetch_array($testi_query)){ ?>
                        <div class="clint__info">
							
							<img src="<?=$test_row['path'];?>" alt="Theja Couture" style="display:block;margin:0 auto;" class="img-responsive">
						</div>
<?php }    ?>

													
												
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php }   ?>

<?php include('footer.php');?>
</div>

<!-- JS Files -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

	$(".tocart").click(function(){
		var str=$(this).attr('id');
		var res = str.split("_");
		var quantity=1;
		var prodid=res[1];
		$.ajax({
			type:'POST',
			url:'ajax-cart.php',
			data:'prid='+prodid+"& quantity="+quantity,
			success:function(data){
				$('#cartcount').html(data);
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
	
	$('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
	dots:false,
	responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false,
            dots:false,
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            loop:false
        }
    }
})
</script>
</body>
</html>

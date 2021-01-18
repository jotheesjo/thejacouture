<?php session_start();
include('db.php');
$url=$_GET[md5('prurl')];
$product_id=base64_decode($_GET[md5('product_id')]);
$query=mysqli_query($conn,"SELECT * FROM `products` WHERE url='$url' AND product_id='$product_id' AND status='1'");
$prod_count=mysqli_num_rows($query);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Product Information</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('head.php'); ?>
</head>

<body>
    <div class="wrapper" id="wrapper">
        <?php include('header.php');?>
        <!-- Start main Content -->
        <div class="maincontent">
            <div class="container pt--80 pb--55">
                <div class="row">

                    <?php if($prod_count<1){ ?>
                    <img src="images/empty_cart.png" class="img-fluid" style="display:block;margin:0 auto;">
                    <?php }else{ ?>
                    <?php $pr_info=mysqli_fetch_assoc($query);
$img_data=json_decode($pr_info['img_path']);
?>
                    <div class="col-lg-12 col-12">
                        <div class="wn__single__product">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="wn__fotorama__wrapper">
                                        <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                            <?php foreach ($img_data as $img_data) { ?>
                                            <a href="<?=$img_data;?>"><img src="<?=$img_data;?>" alt=""></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="product__info__main">
                                        <h1><?=$pr_info['name'];?></h1>
                                        <div class="product-info-stock-sku d-flex">
                                            <p>Availability:<span> <?php if($pr_info['qty']>0){ echo "In stock";}else{ echo "Out of stock";}?></span></p>
                                            <p>SKU:<span> <?=$pr_info['sku'];?></span></p>
                                        </div>

                                        <div class="price-box d-flex">
                                            <?php if($pr_info['offer']>0){ ?>
                                            <span><?=$pr_info['final_price'];?></span>/- INR&nbsp;&nbsp;&nbsp;
                                            <span><strike><?=$pr_info['price'];?>/- INR</strike></span>
                                            <?php }else{ ?>
                                            <span><?=$pr_info['final_price'];?>/- INR</span>

                                            <?php } ?>
                                        </div>
                                        <?php $combine_qry=mysqli_query($conn,"SELECT url,color,product_id FROM products WHERE status='1' AND combine_variable='$pr_info[combine_variable]'");
        								$combine_count=mysqli_num_rows($combine_qry);
        								if($combine_count>1){ ?>
                                        <div class="product-color-label">
                                            <span>Color</span>
                                            <div class="color__attribute d-flex">
                                                <?php while($comb_row=mysqli_fetch_array($combine_qry)){ 
        											$clr=mysqli_fetch_assoc(mysqli_query($conn,"SELECT color_name from variation_color WHERE status='1' AND color_id='$comb_row[color]'")); ?>


                                                <a href="product-details.php?<?=md5('prurl');?>=<?=$comb_row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($comb_row['product_id']);?>">
                                                    <div class="swatch-option color" style="background: transparent; background-size: initial;"><?=$clr['color_name'];?></div>
                                                </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <div class="box-tocart d-flex">
                                            <span>Qty</span>
                                            <input id="qty" class="input-text qty" name="qty" min="1" max="<?=$pr_info['qty'];?>" value="1" title="Qty" type="number">
                                            <div class="addtocart__actions">
											 <?php if($pr_info['qty']>0){ ?>
                                                <button class="tocart" type="submit" title="Add to Cart" id="cart_<?=$product_id;?>">Add to Cart</button>
											 <?php }else{?>
											   <button class="tocart" type="submit" title="Out Of Stock">Out Of Stock</button>
											 <?php }?>
                                            </div>
                                        </div>
                                        <div class="product-addto-links clearfix">
                                            <a class="wishlist" href="#"></a>
                                        </div>
                                        <div class="product__overview">
                                            <?=$pr_info['short_description'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__info__detailed">
                            <div class="pro_details_nav nav justify-content-start" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
                            </div>
                            <div class="tab__container">
                                <!-- Start Single Tab Content -->
                                <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                    <div class="description__attribute">
                                        <?=$pr_info['description'];?>
                                    </div>
                                </div>
                                <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">

                                    <div class="review__attribute">
                                        <h1>Customer Reviews</h1>
                                        <?php 
	                        		$rev_qry=mysqli_query($conn,"SELECT * FROM product_review WHERE pr_id='$product_id' AND status_review='2'");
	                        		$rev_count=mysqli_num_rows($rev_qry);
	                        		if($rev_count>=1){
	                        			while($rev_row=mysqli_fetch_assoc($rev_qry)){ ?>
                                        <h2><?=$rev_row['cust_name'];?></h2>
                                        <h5><?=$rev_row['review_title'];?></h5>
                                        <div class="review__ratings__type d-flex">

                                            <p><?=$rev_row['review'];?></p>
                                            <?php }
	                        		}
	                        		?>

                                        </div>
                                    </div>
                                    <div class="review-fieldset">
                                        <form id="add_review" method="POST">
                                            <div class="review_form_field">
                                                <div class="input__box">
                                                    <span>Summary</span>
                                                    <input type="hidden" name="pr_id" value="<?=$product_id;?>">
                                                    <input id="summery_field" type="text" name="summery">
                                                </div>
                                                <div class="input__box">
                                                    <span>Review</span>
                                                    <textarea name="review"></textarea>
                                                </div>
                                                <div class="review-form-actions">
                                                    <button>Submit Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <p id="reviewinfo"></p>
                            </div>
                        </div>


                    </div>


                    <?php } ?>
                </div>
            </div>
            <!-- End main Content -->

            <?php include('footer.php');?>

        </div>
        <!-- JS Files -->
        <script src="js/vendor/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/active.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(function() {
                $('#add_review').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax-review.php',
                        data: $('#add_review').serialize(),
                        success: function(data) {
                            $('#reviewinfo').html(data);
                            console.log(data);
                        }
                    })
                });
            });

        </script>

        <script>
            $(".tocart").click(function() {
                var str = $(this).attr('id');
                var res = str.split("_");
                var quantity = ($("#qty").val());
                var prodid = res[1];
                $.ajax({
                    type: 'POST',
                    url: 'ajax-cart.php',
                    data: 'prid=' + prodid + "& quantity=" + quantity,
                    success: function(data) {
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

        </script>
</body>

</html>

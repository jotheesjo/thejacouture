<?php session_start();
include('db.php');
// sort
if(isset($_GET['sort'])){
    if($_GET['sort']=='ltoh'){
        $sort_qry='ORDER BY final_price ASC'; 
    }else if($_GET['sort']=='htol'){
       $sort_qry='ORDER BY final_price DESC';  
   }else if($_GET['sort']=='default'){
    $sort_qry=' Order by product_id DESC'; 
   }
}else{
$sort_qry=' Order by product_id DESC'; 
}

// type
if(isset($_GET['type'])){
    $type_list="'". implode("', '", $_GET['type']) ."'";
    $type_qry="AND material IN(".$type_list.")";
}else{
$type_qry=' '; 
}
//echo $type_qry;
// brand
if(isset($_GET['brand'])){
    $brand_list="'". implode("', '", $_GET['brand']) ."'";
    $brand_qry="AND brand IN(".$brand_list.")";
}else{
$brand_qry=' ';
}
// size
if(isset($_GET['size'])){
    $size_list="'". implode("', '", $_GET['size']) ."'";
    $size_qry="AND size IN(".$size_list.")";
}else{
$size_qry=' '; 
}

// color
if(isset($_GET['color'])){
    $color_list="'". implode("', '", $_GET['color']) ."'";
	
    $color_qry="AND color IN(".$color_list.")";
}else{
$color_qry=' '; 
}
//echo $color_qry;
// category
if(isset($_GET['cat'])){
    
    $data=mysqli_fetch_array(mysqli_query($conn,"SELECT id,cat_name FROM `category` WHERE cat_name='$_GET[cat]'"));
    $category_qry="AND category IN(".$data['id'].")";
}else{
$category_qry=' '; 
}

// subcarcategory
if(isset($_GET['scat'])){   
    $scatdata=mysqli_fetch_array(mysqli_query($conn,"SELECT id,scat_name FROM `sub_category` WHERE scat_name='$_GET[scat]'"));
    $scategory_qry="AND subcategory IN(".$scatdata['id'].")";
}else{
$scategory_qry=' '; 
}

// min price
if((isset($_GET['min'])) && ($_GET['min']!='')){
    $min=$_GET['min'];
}else{
    $min='0';
}

// max price
if((isset($_GET['max'])) && ($_GET['max']!='')){
    $max=$_GET['max'];
    $price_qry =" AND final_price BETWEEN ".$min." AND ".$max;
}else{
    $max=' ';
    $price_qry=' '; 
}
//echo "SELECT * FROM products WHERE status='1' ".$category_qry." ".$scategory_qry." ".$type_qry." ".$brand_qry." ".$size_qry." ".$color_qry." ".$price_qry." GROUP BY combine_variable ".$sort_qry." Order by product_id DESC";

 $query=mysqli_query($conn, "SELECT * FROM products WHERE status='1' ".$category_qry." ".$scategory_qry." ".$type_qry." ".$brand_qry." ".$size_qry." ".$color_qry." ".$price_qry." GROUP BY combine_variable ".$sort_qry);
//$query=mysqli_query($conn, "SELECT * FROM products WHERE status='1' ".$category_qry." ".$scategory_qry." ".$type_qry." ".$brand_qry." ".$size_qry." ".$color_qry." ".$price_qry.$sort_qry);

$count_prod=mysqli_num_rows($query);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Theja Courture - Shop</title>
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
                    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                        <?php //if($count_prod>0){ ?>
                        <div class="shop__sidebar">
                            <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">


                                <?php if(isset($data['cat_name'])){ ?>
                                <input type="hidden" name="cat" value="<?=$data['cat_name'];?>">
                                <?php } ?>

                                <?php if(isset($scatdata['scat_name'])){ ?>
                                <input type="hidden" name="scat" value="<?=$scatdata['scat_name'];?>">
                                <?php } ?>

                                <?php $brand_query=mysqli_query($conn,"SELECT * FROM variation_brand WHERE status=1");
                            $brand_count=mysqli_num_rows($brand_query);
                            if($brand_count>0){ ?>
                                <aside class="wedget__categories poroduct--cat">
                                    <h3 class="wedget__title">Brands(<?=$brand_count;?>)</h3>
                                    <ul>
                                        <?php while($brand_row=mysqli_fetch_array($brand_query)){
                                    if(isset($_GET['brand'])){
                                        if (in_array($brand_row['brand_id'], $_GET['brand'])){
                                            $brand_check=" checked";
                                        }else{
                                            $brand_check=" ";
                                        }
                                    }else{
                                        $brand_check=" ";
                                    } ?>
                                        <li><input type="checkbox" name="brand[]" value="<?=$brand_row['brand_id'];?>" onChange="this.form.submit()" <?=$brand_check;?>> <?=$brand_row['brand_name'];?></li>
                                        <?php }?>


                                    </ul>
                                </aside>

                                <?php }
                            ?>
                                <!-- // type -->
                                <?php $type_query=mysqli_query($conn,"SELECT * FROM variation_type WHERE status=1");
                            $type_count=mysqli_num_rows($type_query);
                            if($type_count>0){ ?>
                                <aside class="wedget__categories poroduct--cat">
                                    <h3 class="wedget__title">Material(<?=$type_count;?>)</h3>
                                    <ul>
                                        <?php while($type_row=mysqli_fetch_array($type_query)){ 
                                        if(isset($_GET['type'])){
                                        if (in_array($type_row['type_id'], $_GET['type'])){
                                            $type_check=" checked";
                                        }else{
                                            $type_check=" ";
                                        }
                                    }else{
                                        $type_check=" ";
                                    }
                                    ?>
                                        <li><input type="checkbox" name="type[]" value="<?=$type_row['type_id'];?>" onChange="this.form.submit()" <?=$type_check;?>> <?=$type_row['type_name'];?></li>
                                        <?php }?>


                                    </ul>
                                </aside>

                                <?php }
                            ?>

                                <!-- // size -->
                                <?php //$size_query=mysqli_query($conn,"SELECT * FROM variation_size WHERE status=1");
                           // $size_count=mysqli_num_rows($size_query);
                            //if($size_count>0){ ?>
<!--
                                <aside class="wedget__categories poroduct--cat">
                                    <h3 class="wedget__title">Size(<?=$size_count;?>)</h3>
                                    <ul>
                                        <?php while($size_row=mysqli_fetch_array($size_query)){
                                    if(isset($_GET['size'])){
                                        if (in_array($size_row['size_id'], $_GET['size'])){
                                            $size_check=" checked";
                                        }else{
                                            $size_check=" ";
                                        }
                                    }else{
                                        $size_check=" ";
                                    }
                                     ?>
                                        <li><input type="checkbox" name="size[]" value="<?=$size_row['size_id'];?>" onChange="this.form.submit()" <?=$size_check;?>> <?=$size_row['size_name'];?></li>
                                        <?php }?>


                                    </ul>
                                </aside>
-->

                                <?php //}
                            ?>

                                <!-- // Color -->
                                <?php $color_query=mysqli_query($conn,"SELECT * FROM variation_color WHERE status=1");
                            $color_count=mysqli_num_rows($color_query);
                            if($color_count>0){ ?>
                                <aside class="wedget__categories poroduct--cat">
                                    <h3 class="wedget__title">Color(<?=$color_count;?>)</h3>
                                    <ul>
                                        <?php while($color_row=mysqli_fetch_array($color_query)){ 
                                         if(isset($_GET['color'])){
                                        if (in_array($color_row['color_id'], $_GET['color'])){
                                            $color_check=" checked";
                                        }else{
                                            $color_check=" ";
                                        }
                                    }else{
                                        $color_check=" ";
                                    }?>
                                        <li><input type="checkbox" name="color[]" value="<?=$color_row['color_id'];?>" onChange="this.form.submit()" <?=$color_check;?>> <?=$color_row['color_name'];?></li>
                                        <?php }?>


                                    </ul>
                                </aside>

                                <?php }
                            ?>



                                <aside class="wedget__categories pro--range">
                                    <h3 class="wedget__title">Filter by price</h3>
                                    <div class="content-shopby">
                                        <div class="price_filter s-filter clear">
                                            <div class="row">
                                                <div class="col-md-4 col-xs-12">
                                                    <input type="text" pattern="\d*" class="form-control" id="min" name="min" value="<?php if(isset($_GET['min'])){ echo $_GET['min']; } ?>" placeholder="Min">
                                                </div>

                                                <div class="col-md-4 col-xs-12">
                                                    <input type="text" pattern="\d*" class="form-control" id="max" name="max" value="<?php if(isset($_GET['max'])){ echo $_GET['max']; } ?>" placeholder="Max">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <div class="price--filter">
                                    <button type="submit">Filter</button>
                                </div>

                        </div>
                        <?php //} ?>
                    </div>

                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                       


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">

                                    <p>Total products: <?=$count_prod;?></p>
                                    <div class="orderby__wrapper">
                                        <span>Sort By</span>
                                        <select class="shot__byselect" name="sort" onChange="this.form.submit()">
                                            <option value="default">Default sorting</option>
                                            <option value="ltoh" <?php if(isset($_GET['sort']) && ($_GET['sort']=='ltoh')){ echo " selected";}?>>Price Low to High</option>
                                            <option value="htol" <?php if(isset($_GET['sort']) && ($_GET['sort']=='htol')){ echo " selected";}?>>Price High to Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="tab__container">
                            <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                                <div class="row">
								 <?php if($count_prod>0){ ?>
                                    <?php while($row=mysqli_fetch_assoc($query)){ ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="product product-main">
                                            <div class="product__thumb">
                                                <a class="first__img" href="product-details.php?<?=md5('prurl');?>=<?=$row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($row['product_id']);?>"><?php $img_data=json_decode($row['img_path']);?><img src="<?php echo $img_data[0];?>" alt="product image"></a>
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
                                                <input type="hidden" value="<?=$row['product_id'];?>" id="prid_<?=$row['product_id'];?>" name="product_id" />
                                                <input class="form-control qty" type="hidden" name="quantity" value="1" id="qty_<?=$row['product_id'];?>">
												 <?php if($row['qty']>0){ ?>
                                                <button class="tocart" type="submit" id="cart_<?=$row['product_id'];?>">Add to Cart</button>
												 <?php }else{?>
												  <button class="tocart" type="submit" >Out Of Stock</button>
												 <?php } ?>
                                            </div>
                                        </div>
                                    </div>
								 <?php } }else{?>  <h1 class="innov-c">Innovation under progress, Stay tuned for the update</h1> <?php } ?>

                                </div>
                            </div>
                        </div>
                       

                                </div>
                            </div>
                        </div>
                       
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        .innov-c {
            text-align: center;
            font-weight: 500;
            color: #7b7b7b;
            margin: 50px 10px;
            font-size: 35px;
        }

    </style>

    <script>
        $(".tocart").click(function() {
            var str = $(this).attr('id');
            var res = str.split("_");
            var quantity = ($("#qty_" + res[1]).val());
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
    <script>
        $(".search_active").click(function() {
            $(".search").toggle();
        });

    </script>
</body>

</html>

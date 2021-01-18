<?php 
if(!isset($_SESSION['user_id'])){
	$_SESSION['user_id'] = $_SERVER['REQUEST_TIME'];
	$_SESSION['user_type'] = 'guest';
}
if(isset($_SESSION['cart'])){
$cart_count=count($_SESSION['cart']);
}else{
	$cart_count=0;
}

?>
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6 col-lg-2 offset-lg-1">
						<div class="logo">
							<a href="index.php">
								<img src="images/logo.png" alt="logo images">
							</a>
						</div>
					</div>
					<div class="col-lg-7 d-none d-lg-block">
						<nav class="mainmenu__nav">
						
							<ul class="meninmenu d-flex justify-content-start">
									<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li class="drop"><a href="products.php">Shop</a>
									<div class="megamenu dropdown">
										<ul class="item item01">

											<?php $cat_lists=mysqli_query($conn,"SELECT * FROM `category` WHERE status='active'");
							while($cat_lists_row=mysqli_fetch_assoc($cat_lists)){ 
								$subcat_lists=mysqli_query($conn,"SELECT * FROM `sub_category` WHERE status='1' AND cat_id='$cat_lists_row[id]'");
								$subcat_count=mysqli_num_rows($subcat_lists);
								if($subcat_count>0){ ?>
<li class="label2"><a href="products.php?cat=<?=$cat_lists_row['cat_name'];?>"><?=$cat_lists_row['cat_name'];?></a>
												<ul>
													<?php while($subcat_lists_row=mysqli_fetch_assoc($subcat_lists)){	?>
											<li><a href="products.php?scat=<?=$subcat_lists_row['scat_name'];?>"><?=$subcat_lists_row['scat_name'];?></a></li>

											<?php }  ?>
												</ul>
											</li>

							<?php	}else{ ?>
								<li><a href="products.php?cat=<?=$cat_lists_row['cat_name'];?>"><?=$cat_lists_row['cat_name'];?></a></li>

							<?php }

							 } ?>
										</ul>
									</div>
								</li>
							<!--<li><a href="blogs.php">Blogs</a></li>-->
							<li><a href="contact.php">Contact Us</a></li>
								
							</ul>
						</nav>
					</div>
					<div class="col-md-6 col-sm-6 col-6 col-lg-1">
						<ul class="header__sidebar__right d-flex justify-content-end align-items-center">
							<li class="shop_search"><a class="search__active" href="#"><i class="fa fa-search"></i></a></li>
							<li class="shopcart"><a class="cartbox_active" href="cart.php"><i class="fa fa-shopping-cart"></i>
								<span class="product_qun" id="cartcount"><?php if($cart_count<1){ echo "0";}else{ echo $cart_count;} ?></span></a></li>
							<li class="setting__bar__icon"><a class="setting__active" href="#"><i class="fa fa-user"></i></a>
								<div class="searchbar__content setting__block">
									<div class="content-inner">
										<div class="switcher-currency">
											<strong class="label switcher-label">
												<span>My Account</span>
											</strong>
											<div class="switcher-options">
												<div class="switcher-currency-trigger">
													<div class="setting__menu">
														<span><a href="account-information.php">My Account</a></span>
														<?php if((isset($_SESSION['user_id'])) && ($_SESSION['user_type']!='guest')){
														echo '<span><a href="logout.php">Logout</a></span>';	
														}else{
														echo '<span><a href="login.php">Login/Signup</a></span>';	
														}?>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- Start Mobile Menu -->
				<div class="row d-none">
					<div class="col-lg-12 d-none">
						<nav class="mobilemenu__nav">
							<ul class="meninmenu">
								<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="products.php">Shop</a>
									<ul>
										<?php $cat_lists=mysqli_query($conn,"SELECT * FROM `category` WHERE status='active'");
							while($cat_lists_row=mysqli_fetch_assoc($cat_lists)){ 
								$subcat_lists=mysqli_query($conn,"SELECT * FROM `sub_category` WHERE status='active' AND cat_id='$cat_lists_row[id]'");
								$subcat_count=mysqli_num_rows($subcat_lists);
								if($subcat_count>0){ ?>
<li class="label2"><a href="products.php?cat=<?=$cat_lists_row['cat_name'];?>"><?=$cat_lists_row['cat_name'];?></a>
												<ul>
													<?php while($subcat_lists_row=mysqli_fetch_assoc($subcat_lists)){	?>
											<li><a href="products.php?scat=<?=$subcat_lists_row['scat_name'];?>"><?=$subcat_lists_row['scat_name'];?></a></li>
											<?php }  ?>
												</ul>
											</li>

							<?php	}else{ ?>
								<li><a href="products.php?cat=<?=$cat_lists_row['cat_name'];?>"><?=$cat_lists_row['cat_name'];?></a></li>

							<?php }

							 } ?>
									</ul>
								</li>
<!--							<li><a href="blogs.php">Blogs</a></li>-->
							<li><a href="contact.php">Contact Us</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- End Mobile Menu -->
	            <div class="mobile-menu d-block d-lg-none">
	            </div>
	            <!-- Mobile Menu -->	
			</div>		
		</header>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<div class="brown--color box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="product-search.php">
				<div class="field__search">
					<input type="text" placeholder="Search entire store here..." name="search">
					<div class="action">
						<a href="#"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>
		<!-- End Search Popup -->
<?php //print_r($_SESSION);
?>
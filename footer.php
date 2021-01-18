<!-- Footer Area -->
<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
	<div class="footer-static-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="ft__logo">
						<a href="">
							<img src="images/logo.png" alt="logo">
						</a>
					</div>

					<ul class="social__net social__net--2 d-flex justify-content-center">
						<li><a href="https://www.facebook.com/Tejasree.mulik/" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/theja_couture/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<li><a href="https://api.whatsapp.com/send?phone=+917010235394" target="_blank"><i class="fa fa-whatsapp"></i></a></li> 
					</ul>

				</div>

				<div class="col-lg-3">
					<h3>Our Company </h3>
					<ul class="foo">
						<li><a href="about.php">About Us</a></li>
<!--						<li><a href="blogs.php">Blogs</a></li>-->
						<li><a href="#">Terms & Conditions</a></li>
						<li><a href="privacy-policy.php">Privacy Policy</a></li>
						<li><a href="shipping-and-return-policy.php">Shipping & Return Policy</a></li>
						<li><a href="contact.php">Contact</a></li>

					</ul>
				</div>
				<?php $cat_1=mysqli_query($conn,"SELECT * FROM  category WHERE status='active'"); ?>
				<div class="col-lg-3">
					<h3>Categories </h3>
					<ul class="foo">
						<?php while ($fetch_cat1=mysqli_fetch_array($cat_1)) {
							?>
							<li><a href="products.php?cat=<?php echo $fetch_cat1['cat_name'];?>" target="_blank"><?php echo $fetch_cat1['cat_name'];  ?></a></li>
							
						<?php } ?>
					</ul>
				</div>


				<div class="col-lg-3">
					<h3>Contact</h3>
					<ul class="foo">
					<li><p>Big Bazzar Street, Townhall,Coimbatore-641001.</p></li>
					<li><i class="fa fa-mobile"></i> <a href="tel:7010235394">7010235394</a></li>
					<li><i class="fa fa-mobile"></i> <a href="tel:8754943228">8754943228</a></li>
					<li><i class="fa fa-envelope"></i> <a href="mailto:info@thejacouture.com">info@thejacouture.in</a></li>
				</ul>
				</div>

			</div>
		</div>
	</div>
	<div class="copyright__wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="copyright">
						<div class="copy__right__inner text-left">
							<p><i class="fa fa-copyright"></i>2019 Theja Couture. All rights reserved. Powered by  <a href="https://clouddreams.in" target="_blank">Clouddreams.</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="payment text-right">
						<img src="images/icons/payment.png" alt="" />
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
		<!-- //Footer Area -->
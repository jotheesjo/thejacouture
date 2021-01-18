<?php session_start();
include('db.php'); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Blog Information</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<?php $blog_info=mysqli_fetch_array(mysqli_query($conn,"SELECT id,title,blog,path ,DATE(time) as date FROM blog WHERE id='$_GET[id]'"));?>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title"><?=$blog_info['title'];?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<div class="page-blog-details section-padding--lg bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="blog-details content">
							<article class="blog-post-details">
								<div class="post-thumbnail">
									<img src="images/blog1.jpg" alt="blog images">
								</div>
								<div class="post_wrapper">
									<div class="post_header">
										<h2><?=$blog_info['title'];?></h2>
										<ul class="post_author">
											<li>Posts by : <a href="#">Admin</a></li>
											<li class="post-separator">/</li>
											<li><?=$blog_info['date'];?></li>
										</ul>
									</div>
									<div class="post_content">
										<?=$blog_info['blog'];?>
									</div>
									
									
								</div>
							</article>
							
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php include('footer.php');?>

	</div>
	<!-- //Main wrapper -->

	

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	
</body>
</html>
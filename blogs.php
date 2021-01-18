<?php session_start();
include('db.php'); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Blogs</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
	<?php include('header.php');?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Blogs</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Blog Area -->
        <div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12">
        				<div class="blog-page">
        				<?php $blg_query=mysqli_query($conn,"SELECT id,title,shortblog,path ,DATE(time) as date FROM blog WHERE status='active'");
                        $blg_count=mysqli_num_rows($blg_query);
                        if($blg_count>0){

                        while($blgrow=mysqli_fetch_array($blg_query)){ ?>

                            <article class="blog__post d-flex flex-wrap">
                                <div class="thumb">
                                    <a href="blog-details.php?id=<?=$blgrow['id'];?>">
                                        <img src="<?=$blgrow['path'];?>" alt="<?=$blgrow['title'];?>">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4><a href="blog-details.php?id=<?=$blgrow['id'];?>"><?=$blgrow['title'];?></a></h4>
                                    <ul class="post__meta">
                                        <li>Posts by : <a href="#">Admin</a></li>
                                        <li class="post_separator">/</li>
                                        <li><?=$blgrow['date'];?></li>
                                    </ul>
                                   <?=$blgrow['shortblog'];?>
                                    <div class="blog__btn">
                                        <a class="shopbtn" href="blog-details.php?id=<?=$blgrow['id'];?>">read more</a>
                                    </div>
                                </div>
                            </article>

                        <?php } ?>
                            
                        <?php }else{
                            echo '<h2 class="text-center"> We will update soon...</h2>';
                        } ?>
        				</div>
        				
        			</div>
        		</div>
        	</div>
        </div>
        <!-- End Blog Area -->
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
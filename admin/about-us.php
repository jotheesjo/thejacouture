<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
<?php $return=$db->queryUniqueObject("SELECT about,about_img FROM policies"); ?>
<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">About Us</h3>
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post" enctype="multipart/form-data">
                                		<div class="row">
                                            <div class="form-group">
                                				<label><strong>About Image recommend(350*550):</strong>&nbsp;</label> <br>
                                				<input type="file" class="form-control" name="file_img[]">
                                			</div>
                                            
                                			<div class="form-group">
                                				<label><strong>Description:</strong>&nbsp;</label> <br>
                                				<textarea class="form-control tinymce" name="about">
                                					
                                					<?php echo $return->about; ?>
                                				</textarea>
                                			</div>
                                			<div class="form-group">
                                				<button type="submit" name="btn_about_us" class="btn btn-primary waves-effect waves-light">Submit</button>
                                			</div>
                                		</div>
                                	</form>
                                    <?php if($return->about_img!=''){ ?>
    <img class="img-responsive" src="../<?php echo $return->about_img; ?>"/> 
<?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include("footer.php"); ?>
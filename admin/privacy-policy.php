<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
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
                                    <h3 class="panel-title">Privacy Policy</h3>
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post">
                                		<div class="row">
                                			<div class="form-group">
                                				<label><strong>Description:</strong>&nbsp;</label> <br>
                                				<textarea class="form-control tinymce" name="privacy">
                                					<?php $privacy=$db->queryUniqueObject("SELECT privacy_policy FROM policies");
                                					echo $privacy->privacy_policy; ?>
                                				</textarea>
                                			</div>
                                			<div class="form-group">
                                				<button type="submit" name="btn_privacy" class="btn btn-primary waves-effect waves-light">Submit</button>
                                			</div>
                                		</div>
                                	</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include("footer.php"); ?>
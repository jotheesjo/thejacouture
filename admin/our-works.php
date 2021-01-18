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
                                    <h3 class="panel-title">Our Works</h3>
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post">
                                		<div class="row">
                                			<div class="form-group">
                                				<label><strong>Description:</strong>&nbsp;</label> <br>
                                				<textarea class="form-control tinymce" name="our_works">
                                					<?php $return=$db->queryUniqueObject("SELECT our_works FROM policies");
                                					echo $return->our_works; ?>
                                				</textarea>
                                			</div>
                                			<div class="form-group">
                                				<button type="submit" name="btn_our_works" class="btn btn-primary waves-effect waves-light">Submit</button>
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
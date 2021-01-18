<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Return Policy</h3>
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post">
                                		<div class="row">
                                			<div class="form-group">
                                				<label><strong>Description:</strong>&nbsp;</label> <br>
                                				<textarea class="form-control tinymce" name="return">
                                					<?php $return=$db->queryUniqueObject("SELECT return_policy FROM policies");
                                					echo $return->return_policy; ?>
                                				</textarea>
                                			</div>
                                			<div class="form-group">
                                				<button type="submit" name="btn_return" class="btn btn-primary waves-effect waves-light">Submit</button>
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
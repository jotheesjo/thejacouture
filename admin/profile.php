<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
<?php $admin=$db->queryUniqueObject("SELECT * FROM admin_details"); ?>
<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Profile</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                	<form class="" action="update.php" method="post">
                                		<div class="row">
                                			<div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label><strong>Name:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="name" class="form-control" value="<?=$admin->name;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Mobile:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="mobile" class="form-control" value="<?=$admin->mobile;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Email:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="email" class="form-control" value="<?=$admin->email;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Address1:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="add1" class="form-control" value="<?=$admin->add1;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Address2:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="add2" class="form-control" value="<?=$admin->add2;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>State:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="state" class="form-control" value="<?=$admin->state;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>city:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="city" class="form-control" value="<?=$admin->city;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Pincode:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="pin" class="form-control" value="<?=$admin->pin;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>Web:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="web" class="form-control" value="<?=$admin->web;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                    <label><strong>GST:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="gst" class="form-control" value="<?=$admin->gst;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label><strong>Notification:</strong>&nbsp;</label> <br>
                                                    <input type="text" name="running" class="form-control" value="<?=$admin->running;?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                			<div class="form-group">
                                                <br/>
                                				<button type="submit" name="btn_profile" class="btn btn-primary waves-effect waves-light pull-right">Update</button>
                                			</div>
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
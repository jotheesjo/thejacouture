<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<?php $caid = $_GET['catid'];
$selcat = $db->queryUniqueObject("select * from variation_type where type_id='$caid'");
?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="view_type.php" class="btn btn-info">Back</a>
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Type</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" action="update.php" method="POST" enctype="multipart/form-data" novalidate="">
                                <div class="form-group">
                                        <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?=$selcat->type_name;?>" required="">
                                    <input type="hidden" name="id" class="form-control" value="<?=$selcat->type_id;?>" required="">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Description </label>
                                            <textarea class="form-control" name="description"><?php echo $selcat->type_desc;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" 
                                                    <?php if($selcat->status=='1'){ ?>selected
                                                    <?php }?>>Active
                                                </option>
                                                <option value="0" 
                                                    <?php if($selcat->status=='0'){ ?>selected
                                                    <?php }?>>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <button type="submit"   name="updattype" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
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
        <?php include("footer.php") ?>
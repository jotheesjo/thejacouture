<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<?php $caid = $_GET['catid'];
$selcat = $db->queryUniqueObject("select * from category where id='$caid'");
?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="view_category.php" class="btn btn-info">Back</a>
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Category</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" action="update.php" method="POST" enctype="multipart/form-data" novalidate="">
                                <div class="form-group">
                                        <label>Category Name</label>
                                    <input type="text" name="name" class="form-control" value="<?=$selcat->cat_name;?>" required="">
                                    <input type="hidden" name="catid" class="form-control" value="<?=$selcat->id;?>" required="">
                                        </div>
                                        <div class="form-group">
                                                    <label>Category Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="">
                                                </div>  
                                        <div class="form-group">
                                            <label>Description </label>
                                            <textarea class="form-control" name="description"><?php echo $selcat->cat_desc;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" 
                                                    <?php if($selcat->status=='active'){ ?>selected
                                                    <?php }?>>Active
                                                </option>
                                                <option value="inactive" 
                                                    <?php if($selcat->status=='inactive'){ ?>selected
                                                    <?php }?>>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Image </label>
                                            <img src="<?php echo '../'.$selcat->path;?>" class="img-responsive" style="max-width:150px;">
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <button type="submit"   name="updatcat" class="btn btn-primary waves-effect waves-light">
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
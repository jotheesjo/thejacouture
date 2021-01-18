<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");?>
    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
  <?php $blog=$db->queryUniqueObject("SELECT * FROM blog WHERE id='$_GET[edit]'");?>

	<div class="col-xs-12 col-sm-12">
<div class="panel">
      <div class="panel-heading">Blog</div>
      <div class="panel-body">
<form class="form-auth-small" action="update.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
                  <label for="signin-email" class="control-label">Title </label>
                   <input type="hidden" class="form-control" name="id" required="required" value="<?=$blog->id;?>">
                  <input type="text" class="form-control" name="title" required="required" value="<?=$blog->title;?>">
                </div>
                <div class="form-group">
									<label for="signin-email" class="control-label">Image</label>
									<input type="file" class="form-control" id="banner" name="file_img[]" multiple>
								</div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Description</label>
                 <textarea class="form-control tinymce" name="blog" id="mytextarea"><?=$blog->blog;?></textarea>
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Short Description</label>
                  <textarea class="form-control tinymce" name="shortblog"><?=$blog->shortblog;?></textarea>
                </div>
                <div class="form-group">
									<label for="signin-email" class="control-label">Status</label>
									<select class="form-control" name="status">
										<option value="1" <?php if($blog->status=="1"){ echo " selected";}?>>Active</option>
										<option value="0"  <?php if($blog->status=="0"){ echo " selected";}?>>Inactive</option>
									</select>
								</div>

							<button type="submit" name="update_blog" class="btn btn-primary btn-lg btn-block">Update</button>
								<div class="bottom">
								</div>
							</form>
                </div>
</div>
</div>

</div>
</div>
</div>
<?php include("footer.php") ?>
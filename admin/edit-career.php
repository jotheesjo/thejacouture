<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");?>
    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
  <?php $job=$db->queryUniqueObject("SELECT * FROM job WHERE id='$_GET[edit]'");?>

	<div class="col-xs-12 col-sm-12">
<div class="panel">
      <div class="panel-heading">Career</div>
      <div class="panel-body">
<form class="form-auth-small" action="update.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
                  <label for="signin-email" class="control-label">Title </label>
                   <input type="hidden" class="form-control" name="id" required="required" value="<?=$job->id;?>">
                  <input type="text" class="form-control" name="title" required="required" value="<?=$job->title;?>">
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Experience </label>
                   
                  <input type="text" class="form-control" name="experience" required="required" value="<?=$job->experience;?>">
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Description</label>
                 <textarea class="form-control tinymce" name="description" id="mytextarea"><?=$job->description;?></textarea>
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Short Description</label>
                  <textarea class="form-control tinymce" name="shortdesc"><?=$job->short_desc;?></textarea>
                </div>
                <div class="form-group">
									<label for="signin-email" class="control-label">Status</label>
									<select class="form-control" name="status">
										<option value="active" <?php if($job->status=="active"){ echo " selected";}?>>Active</option>
										<option value="inactive"  <?php if($job->status=="inactive"){ echo " selected";}?>>Inactive</option>
									</select>
								</div>

							<button type="submit" name="update_job" class="btn btn-primary btn-lg btn-block">Update</button>
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
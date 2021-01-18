<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
  <?php if(isset($_GET['success'])){ echo "<h3 class='alert alert-success'>".$_GET['success']."</h3>"; }  ?>
	<div class="col-xs-12 col-sm-12">
<div class="panel">
      <div class="panel-heading">Blogs</div>
      <div class="panel-body">
<form class="form-auth-small" action="insert.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
                  <label for="signin-email" class="control-label">Title</label>
                  <input type="text" class="form-control" name="title" required="required">
                </div>
                <div class="form-group">
									<label for="signin-email" class="control-label">Image</label>
									<input type="file" class="form-control" id="banner" name="file_img[]" multiple>
								</div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Description</label>
                 <textarea class="form-control tinymce" name="blog" id="mytextarea"></textarea>
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Short Description</label>
				  <textarea class="form-control tinymce" name="short_blog"></textarea>
                </div>
							<button type="submit" name="btn_blog" class="btn btn-primary btn-lg btn-block">Add Blog</button>
								<div class="bottom">
								</div>
							</form>
                </div>
</div>
</div>

							<div class="col-xs-12 col-sm-12">
                <div class="panel">
      <div class="panel-heading">Blogs</div>
      <div class="panel-body">
<table class="table">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Image</th>
        <th>Title</th>
		<th>Status</th>      
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php $sql="select * from blog";
 $result = $db->query($sql);
 $i=0;
 while($row=mysqli_fetch_array($result)){ 
 $i++;?>
	 <tr>
        <td><?=$i;?></td>
        <td><img src="../<?=$row['path'];?>" class="img-responsive" width='100'/></td>
        <td><?=$row['title'];?></td>
        <td><?php if($row['status']=='1'){ echo "active"; }else{ echo "Inactive"; }?></td>
		<td>
		<form method="post" action="">
		<input type="hidden" name="id" value="<?=$row['id'];?>">
		<button type="name" name="delete" class="btn btn-primary"><span class="lnr lnr-trash"></span></button>
     <a href="edit-blog.php?edit=<?=$row['id'];?>" class="btn btn-success"><span class="fa fa-eye"></span></a>
		</form>
		</td>
      </tr>
 <?php }?>
      

    </tbody>
  </table>
  </div>
</div>
</div>


</div>
</div>
</div>
<?php if(isset($_POST['delete'])){
$d=$db->query("DELETE FROM blog WHERE id='$_POST[id]'");
if($d) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='blog.php?success=Blog delete successfully';
    </SCRIPT>");
  }

} ?>
<?php include("footer.php") ?>
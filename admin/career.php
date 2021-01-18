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
      <div class="panel-heading">Career</div>
      <div class="panel-body">
<form class="form-auth-small" action="insert.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
                  <label for="signin-email" class="control-label">Title</label>
                  <input type="text" class="form-control" name="title" required="required">
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Experience</label>
                  <input type="text" class="form-control" name="experience" required="required">
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Description</label>
                 <textarea class="form-control tinymce" name="desc" id="mytextarea"></textarea>
                </div>
                <div class="form-group">
                  <label for="signin-email" class="control-label">Short Description</label>
				  <textarea class="form-control tinymce" name="short_desc"></textarea>
                </div>
							<button type="submit" name="btn_experience" class="btn btn-primary btn-lg btn-block">Add Career</button>
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
        <th>Title</th>
        <th>Short descripton</th>
		<th>Status</th>      
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php $sql="select * from job";
 $result = $db->query($sql);
 $i=0;
 while($row=mysqli_fetch_array($result)){ 
 $i++;?>
	 <tr>
        <td><?=$i;?></td>
        <td><?=$row['title'];?></td>
        <td><?=$row['short_desc'];?></td>
        <td><?=$row['status'];?></td>
		<td>
		<form method="post" action="">
		<input type="hidden" name="id" value="<?=$row['id'];?>">
		<button type="name" name="delete" class="btn btn-primary"><span class="lnr lnr-trash"></span></button>
     <a href="edit-career.php?edit=<?=$row['id'];?>" class="btn btn-success"><span class="fa fa-eye"></span></a>
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
$d=$db->query("DELETE FROM job WHERE id='$_POST[id]'");
if($d) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='career.php?success=Career delete successfully';
    </SCRIPT>");
  }

} ?>
<?php include("footer.php") ?>
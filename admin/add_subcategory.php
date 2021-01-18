<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Subcategory</h3>
                                </div>
                                <div class="panel-body">
								 <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                            <form class="" action="insert.php" method="POST" enctype="multipart/form-data" novalidate="">
                                                
                                                <div class="form-group">
                                                    <label>Category</label>
                                                   <select name="catid" class="form-control">
                <?php $userview = $db->query("select * from category where status='active'");
            while($ro = mysqli_fetch_array($userview)){
            ?>
              <option value="<?php echo $ro[0];?>"><?php echo $ro[1];?></option>
                            <?php } ?> 
                            </select>
                             </div>
                             <div class="form-group">
                                                    <label>Subcategory</label>
                                                    <input type="text" name="scatname" class="form-control" required="" placeholder="Type something">
                                                </div>
												<div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="" placeholder="Type something">
                                                </div>
												<div class="form-group">
                                                    <label>Description </label>
                                                    <textarea  class="form-control" name="scatdesc"   required="" placeholder="Type something"> </textarea>
                                                </div>
												
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit" name="subcatsubmit" class="btn btn-primary waves-effect waves-light">
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
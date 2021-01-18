<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>

<?php $scaid = $_GET['scatid'];

$sc = $db->queryUniqueObject("select * from sub_category where id='$scaid' ");
			?> 
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="view_subcategory.php" class="btn btn-info">Back</a>
                    <!-- BASIC TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Subategory</h3>
                        </div>
                        <div class="panel-body">
                                            <form class="" action="update.php" method="POST" enctype="multipart/form-data" novalidate="">
                                                
                                                 <div class="form-group">
                                                    <label>Category</label>
                                                   <select name="catid" class="form-control" required>
                                                <option value=""> select category</option>
                                                        <?php    
                                                        $t2 =  $sc->cat_id;
              $c= $db->query("select * from category where status='active'");
              while ($r1 = $db->fetchNextObject()) {
                  if($r1->id == $t2 ) 
                  echo "<option value='$r1->id' selected>$r1->cat_name</option>";
                  else
                  echo "<option value='$r1->id'>$r1->cat_name</option>";
              }
              ?>  </select>  </div>

                                                <div class="form-group">
												<input type="hidden" name="scatid" value="<?php echo $sc->id;?>"/>
                                                    <label>Subcategory</label>
                                                    <input type="text" name="scatname" value="<?php echo $sc->scat_name;  ?>" class="form-control" required="" placeholder="Type something">
                                                </div>
												<div class="form-group">
                                                    <label>Image</label>
													
                                                    <input type="file"  name="file"  class="form-control" required="" placeholder="Type something">
                                                </div>
												<div class="form-group">
                                                    <label>Description </label>
<textarea  class="form-control" name="scatdesc" required=""><?php echo $sc->scat_desc;  ?></textarea>
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
                                            <label>Image </label>
                                            <img src="<?php echo '../'.$sc->scat_img; ?>" style="width:150px;">
                                        </div>

                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="updatsubcat" class="btn btn-pink waves-effect waves-light">
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
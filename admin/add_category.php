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
                                    <h3 class="panel-title">Add Category</h3>
                                </div>
                                <div class="panel-body">
								 <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                    <form class="" action="insert.php" method="POST" enctype="multipart/form-data" novalidate="">                         <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" name="catname" class="form-control" required="" >
                                                </div>
                                                  <div class="form-group">
                                                    <label>Category Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="">
                                                </div>  
                                                <div class="form-group">
                                                    <label>Description </label>
                                                   <textarea  class="form-control" name="catdesc" required=""> </textarea>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                        <button type="submit"   name="catsubmit" class="btn btn-primary waves-effect waves-light">
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
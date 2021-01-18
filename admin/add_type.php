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
                                    <h3 class="panel-title">Add Type</h3>
                                </div>
                                <div class="panel-body">
                                    <form class="" action="insert.php" method="POST" enctype="multipart/form-data" novalidate="">                         <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="type_name" class="form-control" required="" >
                                                </div>
                                                 
                                                <div class="form-group">
                                                    <label>Description </label>
                                                   <textarea  class="form-control" name="type_desc" required=""> </textarea>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                        <button type="submit"   name="add_type" class="btn btn-primary waves-effect waves-light">
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
<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>


  <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Brand</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Brand</h3>
                                </div>
                                <div class="panel-body">
                                    <?php
 if(isset($_GET['editid'])) {
$editid = $_GET['editid'];
$ed = $db->queryUniqueObject("SELECT * from service_brand where id='$editid'")
?>  
<form class="" action="update.php" method="POST">                                               
                                                <div class="form-group">
                                                    <label>Brand Name</label>
                                                    <input type="hidden"  name="brandid" value="<?php echo $ed->id; ?>"  required=""> 
                                                    <input  class="form-control" name="ueditname" value="<?php echo $ed->name; ?>"   required=""> 
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="updateservicebrands" class="btn btn-primary waves-effect waves-light">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
<?php } else if(!isset($GET['editid'])){ ?>
                                            <form class="" action="insert.php" method="POST" enctype="multipart/form-data" novalidate=""> 
                                               <div class="form-group">
                                                    <label>Brand Name</label>
                                                    <input type="text"  class="form-control" name="brand"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="servicebrandsubmit" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php } ?>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-6">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Brand List</h3>
                                </div>
                                <div class="panel-body">
                                    <table id="datatable" class="table responsive-data-table  dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>Brand</th>
                                                <th>Action</th>
                                               </thead>
                                                <tbody>
                                                    <?php $userview = $db->query("select * from service_brand WHERE status='active'");
                                                      $i=1;
            while($ro = mysqli_fetch_array($userview)){
            ?> 
          <tr role="row" class="odd">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $ro['name']; ?></td>
                                                  
                                                    <td>
<a href="add-service-brand.php?editid=<?php echo $ro['id']; ?>" class="btn btn-primary btn-sm " > <i class="fa fa-pencil"></i> </a>
<button class="btn btn-danger btn-sm " data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"> <i class="fa fa-trash"></i></button>
 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                           <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[1]; ?> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                             <div class="modal-body">
                                                            <p>Are You sure you want to delete this Brand</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="delid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deleteservicebrand" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>
                                                     
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->    

                                                    </td>
                                                </tr> 
            <?php } ?> 
                                                </tbody>
                                            </table>
                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>
        </div>

                          <?php include("footer.php") ?>
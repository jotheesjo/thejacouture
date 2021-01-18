<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<?php
if (isset($_GET['delid'])) {
}
?>

   <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add Banner</h3>
                                </div>
                                <div class="panel-body">
                                     <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                  <form class="" action="insert.php" method="POST" enctype="multipart/form-data" >
                        <div class="form-group">
                                                    <label>Banner Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="required" placeholder="Type something">
                                                    
                                                </div>

                                                <div class="form-group">
                                                    <div>
                                                      <button type="submit"   name="bannersubmit" class="btn btn-primary waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                </div>
                              </div>
                            </div>




                            <div class="col-md-6">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Banner List</h3>
                                </div>
                                <div class="panel-body">
                                <div class="col-sm-12">
                                            <table id="datatable" class="table responsive-data-table  dataTable" role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                <th  >S.no</th>
                                                 <th >Image</th>
                                                 <th> Status</th>
                                                 <th> Update</th>
                                            </tr>
                                               </thead>
                                                <tbody>
                                                  <?php $banview = $db->query("select * from banner ");
$i=1;  while($bv = mysqli_fetch_array($banview)){
            ?> 
                                               <tr>
<td><?php echo   $i++; ?></td>
<td> <img src="<?php echo '../'.$bv['path']; ?>" style="height:80px;width:150px;">  </td>
<td><?php $sta= $bv[2];
if($sta=='1'){ echo "Active"; }else{ echo "Inactive"; } ?>
</td>
<td> 
     <a class="btn btn-warning btn-sm" data-toggle="modal" data-target=".edit<?php echo $bv['id']; ?>"><i class="fa fa-pencil"></i></a>
     <a class="btn btn-danger btn-sm" data-toggle="modal" data-target=".delete<?php echo $bv['id']; ?>"><i class="fa fa-trash-o"></i></a>
</td>
 <div class="modal fade edit<?php echo $bv['id']; ?>" >
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title  col-xs-6" id="mySmallModalLabel"> Update  </h5>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form action="update.php" method="POST">
<div class="form-group">
<select name="bstatus" class="form-control">
<option value="1"  <?php if($sta=='1') { echo 'selected'; } ?> > active</option>
<option value="0" <?php if($sta=='0') { echo 'selected'; } ?> >inactive</option>
</select>
</div> 
</div>
<div class="modal-footer">
<input type="hidden" value="<?php echo $bv[0]; ?>"  name="banid">
<button type="submit"  name="bannerstatus" class="btn btn-primary">Save</button>
<button  class="btn btn-secondary" data-dismiss="modal">No</button>
</form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Delete -->
 <div class="modal fade delete<?php echo $bv['id']; ?>" >
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title col-xs-6" id="mySmallModalLabel"> Confirm Delete Banner?  </h5>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-footer">
<form action="update.php" method="POST">
<input type="hidden" value="<?php echo $bv[0]; ?>"  name="banid">
<button type="submit"  name="bannerdelete" class="btn btn-primary">Save</button>
<button  class="btn btn-secondary" data-dismiss="modal">No</button>
</form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->






</tr>

                                                

            <?php } ?> 

                                                </tbody>  

                                            </table></div>
                                </div>
                              </div>
                            </div>



                          </div>
                        </div>
                      </div>




 

								

								<?php include("footer.php") ?>
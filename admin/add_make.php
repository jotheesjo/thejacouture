<?php include("header.php") ?>
<?php include("nav_bar.php") ?>             
<?php include("nav_left.php") ?>

                                    <div class="card m-b-20 panel">
                                        <div class="card-block">

                                            

 <fieldset>                                                    <div class="row">
                                                        <div class="col-md-6">
<?php
 if(isset($_GET['editid'])) {
$editid = $_GET['editid'];

$ed = $db->queryUniqueObject("SELECT * from make where id='$editid' and status='active' ")
?>  


<h4 class="mt-0 header-title">Edit Make</h4>
<form class="" action="update.php" method="POST" enctype="multipart/form-data" novalidate="">                                               
                                                <div class="form-group">
                                                    <label>Make Name</label>
                                                    <input type="hidden"  name="makeid" value="<?php echo $ed->id; ?>"  required="">
                                                    <input type="text" name="makename" value="<?php echo $ed->name; ?>" class="form-control" required="" >
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Category Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="">
                                                </div> -->
                                                <div class="form-group">
                                                    <label>Remark </label>
                                                    <input  class="form-control" name="makedesc" value="<?php echo $ed->remark; ?>"   required=""> 
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="updatemake" class="btn btn-pink waves-effect waves-light">
                                                            Save
                                                        </button>
                                                       
                                                    </div>
                                                </div>
                                            </form>

<?php } else if(!isset($GET['editid'])){ ?><h4 class="mt-0 header-title">Add Make</h4>

                                            <form class="" action="insert.php" method="POST" enctype="multipart/form-data" novalidate="">                                               
                                                <div class="form-group">
                                                    <label>Make Name</label>
                                                    <input type="text" name="makename" class="form-control" required="" >
                                                </div>
												<!-- <div class="form-group">
                                                    <label>Category Image</label>
                                                    <input type="file"  name="file"  class="form-control" required="">
                                                </div> -->
												<div class="form-group">
                                                    <label>Remark </label>
                                                    <textarea  class="form-control" name="makedesc"   required=""> </textarea>
                                                </div>
												
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="makesubmit" class="btn btn-pink waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                       
                                                    </div>
                                                </div>
                                            </form>

                                            <?php } ?> 
                                        </div> 
<div class="col-md-6">



 <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">

                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>Make Name</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                                </thead>


                                                <tbody>
                                                    <?php $userview = $db->query("select * from make where status='active' ");
                                                    $i=1;
            while($ro = mysqli_fetch_array($userview)){
            ?> 
                                                <tr role="row" class="odd">
                                                    <td><?php echo $i++;  ?></td>
                                                    <td><?php echo $ro[1]; ?></td>
                                                    <td><?php echo $ro[2]; ?></td>
                                                    

                                                    <td>
<a href="add_make.php?editid=<?php echo $ro[0]; ?>" class="btn btn-primary btn-sm " > <i class="fa fa-pencil"></i> </a>
<button class="btn btn-danger btn-sm " data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"> <i class="fa fa-trash"></i></button>
 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[1]; ?>  </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to delete this Make</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="delid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deletemake" class="btn btn-primary">Yes</button>
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
</div></fieldset> 

                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6" >



                                </div>
								
								<?php include("footer.php") ?>
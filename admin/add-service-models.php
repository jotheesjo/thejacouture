<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>


  <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Model</h3>
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
$ed = $db->queryUniqueObject("SELECT * from service_model where id='$editid' and status='active' ")
?>  
<form class="" action="update.php" method="POST">                                               
   <div class="form-group">
                                                    <label>Brand</label>
                                                    <input type="hidden"  name="modelid" value="<?php echo $ed->id; ?>"  required="">
                                                    <select name="brands" class="form-control" required>
                                                    <?php $category=$db->query("select * from service_brand WHERE status='active'"); 
                                                    while($row=mysqli_fetch_array($category)){ ?>
                                                        <option value="<?=$row['id'];?>" <?php if($ed->brand ==$row['id']){?>selected<?php } ?>><?=$row['name'];?></option>
                                                     <?php }?>
                                                    </select>
                                                </div>    
                                                <div class="form-group">
                                                    <label>Model</label>
                                                    <input  class="form-control" name="model" value="<?php echo $ed->model; ?>"   required=""> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Flash Mobile</label>
                                                    <input type="text"  class="form-control" name="flash" value="<?php echo $ed->flash; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Charging Issue</label>
                                                    <input type="text"  class="form-control" name="charge" value="<?php echo $ed->charge; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Camera Issue</label>
                                                    <input type="text" class="form-control" name="camera" value="<?php echo $ed->camera; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Touch&LCD Repair</label>
                                                    <input type="text"  class="form-control" name="tl" value="<?php echo $ed->tl; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Speaker Issue</label>
                                                    <input type="text"  class="form-control" name="speaker" value="<?php echo $ed->speaker; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Other Issue</label>
                                                    <input type="text"  class="form-control" name="other_issue" value="<?php echo $ed->other_issue; ?>" required>  
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"   name="updateservicemodel" class="btn btn-primary waves-effect waves-light">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
<?php } else if(!isset($GET['editid'])){ ?>
                                            <form class="" action="insert.php" method="POST" > 
                                                <div class="form-group">
                                                    <label>Brand Type</label>
                                                    <select name="brands" class="form-control" required>
                                                    <?php $brand=$db->query("select * from service_brand WHERE status='active'"); 
                                                    while($row=mysqli_fetch_array($brand)){ ?>
                                                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                                     <?php }?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Model</label>
                                                    <input type="text"  class="form-control" name="model"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Flash Mobile</label>
                                                    <input type="text"  class="form-control" name="flash"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Charging Issue</label>
                                                    <input type="text"  class="form-control" name="charge"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Camera Issue</label>
                                                    <input type="text"  class="form-control" name="camera"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Touch&LCD Repair</label>
                                                    <input type="text"  class="form-control" name="tl"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Speaker Issue</label>
                                                    <input type="text"  class="form-control" name="speaker"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <label>Other Issue</label>
                                                    <input type="text"  class="form-control" name="other_issue"   required>  
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit" name="servicemodelsubmit" class="btn btn-primary waves-effect waves-light">
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
                                    <h3 class="panel-title">Model List</h3>
                                </div>
                                <div class="panel-body">
                                    <table id="datatable" class="table responsive-data-table  dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Action</th>
                                               </thead>
                                                <tbody>
                                                    <?php $userview = $db->query("select a.*,b.* from service_model a, service_brand b where b.id=a.brand");
                                                      $i=1;
            while($ro = mysqli_fetch_array($userview)){
            ?> 
          <tr role="row" class="odd">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $ro['name']; ?></td>
                                                    <td><?php echo $ro['model']; ?></td>
                                                  
                                                    <td>
<a href="add-service-models.php?editid=<?php echo $ro[0]; ?>" class="btn btn-primary btn-sm " > <i class="fa fa-pencil"></i> </a>
<button class="btn btn-danger btn-sm " data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"> <i class="fa fa-trash"></i></button>
 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                           <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro['model']; ?> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                             <div class="modal-body">
                                                            <p>Are You sure you want to delete this Model</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="delid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deletemodel" class="btn btn-primary">Yes</button>
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
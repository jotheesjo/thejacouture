<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                             <?php if(isset($_GET['msg'])){
                                echo '<h4>'.$_GET['msg'].'</h4>';
                            }?>
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Review List</h3>
                                </div>
                                <div class="panel-body">
                                    <table width="100%"  class="table convert-data-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Reviewer</th>
                                                <th>Description</th>                                                
                                                <th>Product Name</th>
                                                <th>Review Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $review = $db->query("select * from product_review ORDER By review_date DESC ");
                                            $sno = 1;
                                            while($row1 = mysqli_fetch_array($review)){ ?>
                                                <tr role="row" class="odd <?php if($row1['notification']=='1'){ echo 'fresh'; } ?>">
                                                    <td><?php echo $sno++;  ?></td>
                                                    <td><?php  echo $row1['cust_name'];?></td>
                                                    <td><?php  echo $row1['review'];?></td>
                                                    <td><?php  $proname=$db->queryUniqueObject("SELECT name from products WHERE product_id='$row1[pr_id]'");
                                                    echo $proname->name;?></td>
                                                    <td><?php  echo $row1['review_date'];?></td>
                                                    <td><?php  if($row1['status_review']=='0'){ echo "Not approved";}else if($row1['status_review']=='2'){ echo "Pending"; }else{ echo "Approved"; }?></td>
                                                    <td>

                                                          <a href="javascript:void(0);" class="text-muted btn btn-danger btn-sm"  data-toggle="modal" data-target=".del<?php echo $row1[review_id]; ?>" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><i class="lnr lnr-trash font-18"></i></a>
 <div class="modal fade del<?php echo $row1['review_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title mt-0" id="mySmallModalLabel">Delete</h3>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to Delete this Review </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="proid" value="<?php echo $row1['review_id']; ?>"> 
                                                            <button type="submit"  name="deleteproductreview" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>                                                  
                                                            </div> <!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->  


                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target=".reviewedit<?php  echo $row1['review_id'];?>"> <i class="lnr lnr-pencil"></i></button>
                                                        <div class="modal fade reviewedit<?php echo $row1['review_id'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Status</h5>
                                                                </div>
                                                         <form action="update.php" method="POST">

                                                              <div class="modal-body">
                                                         <input type="hidden" name="reviewid" value="<?php echo $row1['review_id'];?>">
                                                    <div class="form-group">
                                                    <label>Order Status</label>
                                                   <select name="status" class="form-control">
                                                    <option disabled selected value>Change status</option>
                                                    <option value="1">Approve</option>
                                                    <option value="0">Reject</option>
                                                   </select>
                                                </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"  name="updatereview" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>
                                                        
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->

                                                    </td>
                                                <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("footer.php"); ?>        
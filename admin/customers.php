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
                            <!-- BASIC TABLE -->
                            <?php if(isset($_GET['msg'])){
                                echo '<h4>'.$_GET['msg'].'</h4>';
                            }?>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Customers</h3>
                                </div>
                                <div class="panel-body">
                                    <table width="100%"  class="table convert-data-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S&nbsp;no.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $review = $db->query("select * from customer ORDER By customer_id DESC");
                                            $sno = 1;
                                            while($row1 = mysqli_fetch_array($review)){ ?>
                                                <tr role="row" class="odd">
                                                    <td><?php echo $sno++;  ?></td>
                                                    <td><?php  echo $row1['name'];?></td>
                                                    <td><?php  echo $row1['email'];?></td>
                                                    <td><?php  if($row1['status']==0){ echo "Inactive";}else{ echo "Active";}?></td>
                                                    <td><a href="customer-profile.php?id=<?=$row1['customer_id'];?>"><button class="btn btn-info btn-sm"><i class="lnr lnr-user"></i></button></a>
                                                        <!-- <a href="edit-profile.php?id=<?=$row1['customer_id'];?>"><button class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button></a> -->
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".reviewedit<?php  echo $row1['customer_id'];?>"> <i class="lnr lnr-magic-wand"></i></button>
                                                        <div class="modal fade reviewedit<?php echo $row1['customer_id'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Status</h5>
                                                                </div>
                                                         <form action="update.php" method="POST">

                                                              <div class="modal-body">
                                                         <input type="hidden" name="userid" value="<?php echo $row1['customer_id'];?>">
                                                    <div class="form-group">
                                                    <label>Status</label>
                                                   <select name="status" class="form-control">
                                                    <option disabled selected value>Change status</option>
                                                    <option value="1" <?php if($row1['status']=='1'){ echo "seleted"; }?>>Active</option>
                                                    <option value="0" <?php if($row1['status']=='0'){ echo "seleted"; }?>>Inactive</option>
                                                   </select>
                                                </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"  name="updatecustomertatus" class="btn btn-primary">Yes</button>
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
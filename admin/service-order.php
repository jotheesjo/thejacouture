<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Review</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Review List</h3>
                                </div>
                                <div class="panel-body">
                                    <table width="100%"  class="table convert-data-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Problem</th>
                                                <th>Additional Problems</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $service_order = $db->query("select * from service_order ORDER By order_time DESC ");
                                            $sno = 1;
                                            while($row1 = mysqli_fetch_array($service_order)){ ?>
                                                <tr role="row" class="odd <?php if($row1['notification']=='1'){ echo 'fresh'; } ?>">
                                                    <td><?php echo $sno++;  ?></td>
                                                    <td><?php  echo $row1['name'];?></td>
                                                    <td><?php  echo $row1['email'];?></td>
                                                    <td><?php  $servbrand=$db->queryUniqueObject("SELECT name from service_brand WHERE id='$row1[brand]'");
                                                    echo $servbrand->name;?></td>
                                                    <td><?php  $servmodel=$db->queryUniqueObject("SELECT model from service_model WHERE id='$row1[model]'");
                                                    echo $servmodel->model;?></td>
                                                    <td><?php  echo $row1['problems'];?></td>
                                                    <td><?php  echo $row1['additional_problem'];?></td>
                                                    <td><?php  echo $row1['totalp'];?></td>
                                                    <td><?php  echo $row1['status'];?></td>
                                                    <td><button class="btn btn-warning btn-sm" data-toggle="modal" data-target=".vieworder<?php  echo $row1['id'];?>"> <i class="fa fa-eye"></i></button>
                                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".update<?php  echo $row1['id'];?>"> <i class="fa fa-edit"></i></button>
                                                        <div class="modal fade update<?php echo $row1['id'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Order</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Status</th>
                                                                            <td>
                                <form method="post" action="update.php">
                                    <input type="hidden" name="id" value="<?=$row1['id'];?>">
                                    <select class="form-control" name="servordstatus">
                                        <option value="open">Open</option>
                                        <option value="pending">Pending</option>
                                        <option value="cancel">Cancel</option>
                                        <option value="complete">Complete</option>
                                    </select>
                                
                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                            <button  type="submit" name="servstatus" class="btn btn-primary">Change</button>       
                                                            <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                            </div>
                                                        </div>
                                                        </div>


                                                        <div class="modal fade vieworder<?php echo $row1['id'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Order</h5>
                                                                </div>
                                                        
                                                        <div class="modal-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <td><?=$row1['name'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>E-mail</th>
                                                                            <td><?=$row1['email'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mobile No</th>
                                                                            <td><?=$row1['mobile'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Alternate Mobile</th>
                                                                            <td><?=$row1['alternatemobile'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td><?=$row1['city'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td><?=$row1['state'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td><?=$row1['pincode'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address</th>
                                                                            <td><?=$row1['address'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Land Mark</th>
                                                                            <td><?=$row1['landmark'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Brand & Model</th>
                                                                            <td><?=$servbrand->name.' '.$servmodel->model;?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Problems</th>
                                                                            <td><?=$row1['problems'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Additional Problem</th>
                                                                            <td><?=$row1['additional_problem'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Paid Amount</th>
                                                                            <td><?=$row1['totalp'];?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Order Time</th>
                                                                            <td><?=$row1['order_time'];?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                              </div>
                                                        <div class="modal-footer">
                                                            <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                        
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
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
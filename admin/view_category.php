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
                                    <h3 class="panel-title">View Category</h3>
                                </div>
                                <div class="panel-body">
                                    <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                   <table id="datatable" class="table responsive-data-table  dataTable "  role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                <th>S.no</th>
                                                <th tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 131px;">Category</th>
                                                <th>Image</th>
                                                <th>Description</th>
												<th>Status</th>
                                                <th>Action</th>
                                                </thead>


                                                <tbody>
                                                    <?php $userview = $db->query("select * from category");
                                                    $i=1;
            while($ro = mysqli_fetch_array($userview)){
            ?> 
            
                                                <tr role="row" class="odd" <?php if($ro['status']=='inactive'){ echo 'style="background-color:#cccccc"'; } ?>>
                                                          <td><?php  echo $i++; ?> </td>
                                                    <td class="sorting_1"><?php echo $ro['cat_name']; ?></td>
                                                    <td><img src="<?php echo '../'.$ro['path']; ?>" style="width: 80px;height: 80px;"></td>
                                                    <td><?php echo $ro['cat_desc']; ?></td>
													<td><?php echo $ro['status']; ?></td>
                                                    <td><a href="edit_category.php?catid=<?php echo $ro[0]; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button> </a>

                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"><i class="fa fa-trash"></i></button>

 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[1]; ?> Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to delete this category.&hellip;</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="catid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deletecat" class="btn btn-primary">Yes</button>
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
							
							
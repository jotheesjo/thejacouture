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
                                    <h3 class="panel-title">View Subcategory</h3>
                                </div>
                                <div class="panel-body">
                                    <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
											<table id="datatable" class="table responsive-data-table  dataTable  " role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                    <th>S.no</th>
                                                <th>Category</th>
												<th tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 131px;">Sub category</th>
												<th>Image</th>
												<th>Description</th>
												<th>Status</th>
												<th>Action</th>
                                                </thead>


                                                <tbody>
													<?php $userview = $db->query("select * from sub_category where status='1' ");
                                                    $i=1;
			while($ro = mysqli_fetch_array($userview)){
			?> 
			
                                                <tr role="row" class="odd">
                                                          <td><?php  echo $i++; ?></td>

                                                    <td><?php  $c = $ro[1]; 
                                                    $c1 = $db->queryUniqueObject("select * from category where id=$c ");
                                                    echo $c1->cat_name;
                                                    ?></td>
                                                    <td class="sorting_1"><?php echo $ro[2]; ?></td>
                                                    <td><img src="<?php echo '../'.$ro[3]; ?>" style="width:80px;"></td>
                                                    <td><?php echo $ro[4]; ?></td>
													<td><?php if($ro['status']=='1'){ echo "Active"; }else{ echo "Inactive"; }?></td>
                                                    <td>
                                                        <a href="edit_subcategory.php?scatid=<?php echo $ro[0]; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button> </a>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"><i class="fa fa-trash"></i></button>

 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[2]; ?>  sub Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to delete this sub category.&hellip;</p>
                                                        </div>
                                                        <div class="modal-footer">
														<form action="delete.php" method="POST">
														<input type="hidden" name="scatid" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="deletesubcat" class="btn btn-primary">Yes</button>
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
							
							
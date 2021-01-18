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
                            <a href="add_color.php" class="btn btn-info">Add Color</a>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Color</h3>
                                </div>
                                <div class="panel-body">
                                    <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
    <?php $count = $db->query("select * from variation_color");
        if (mysqli_num_rows($count) != 0)
  {
    ?>
                                   <table id="datatable" class="table responsive-data-table  dataTable "  role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                <th>S.no</th>
                                                <th>Name</th>
                                                <th >Description</th>
                                                <th>Status</th>
                                                <th >Action</th>
                                                </thead>


                                                <tbody>
                                                <?php $variation = $db->query("select * from variation_color");
                                                    $i=1;
            while($ro = mysqli_fetch_array($variation)){
            ?> 
            
                                                <tr role="row" class="odd" <?php if($ro['status']=='0'){ echo 'style="background-color:#cccccc"'; } ?>>
                                                          <td><?php  echo $i++; ?> </td>
                                                    <td class="sorting_1"><?php echo $ro['color_name']; ?></td>
                                                   
                                                    <td><?php echo $ro['color_desc']; ?></td>
                                                    <td><?php if($ro['status']=='1'){ echo 'Active';}else{
                                                        echo "Inactive";
                                                     } ?></td>
                                                    <td><a href="edit_color.php?catid=<?php echo $ro[0]; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button> </a>

                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".edit<?php echo $ro[0]; ?>"><i class="fa fa-trash"></i></button>

 <div class="modal fade edit<?php echo $ro[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete <?php echo $ro[1]; ?> Color variation</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to delete this variation.&hellip;</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="color_id" value="<?php echo $ro[0]; ?>"> 
                                                            <button type="submit"  name="delete_color" class="btn btn-primary">Yes</button>
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
                                        <?php }else{
                                            echo "No Attributes are added";
                                        } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                            
							<?php include("footer.php") ?>
							
							
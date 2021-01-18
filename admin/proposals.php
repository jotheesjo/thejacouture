<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>

 <style type="text/css">
    table {
    width: 100%;
    display:block;
     overflow: auto;
}
</style>
 
   <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                        Product List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                    <!-- responsive-data-table table-striped  -->
                                     <table width="100%"  class="table convert-data-table table-striped">
                                            <thead>
                                            <tr>
       <th>Sno</th>
<th>Orderid</th>
<th>SpareID</th>
<th>vendor detail</th>
<th>Proposed Price</th>
<th>Status</th>
<th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
$sql = $db->query("select * from proposed_items where status='active'");
$i=1;
while($row = mysqli_fetch_assoc($sql))
{ ?>

<tr role="row" class="odd">

                                                <td class="sorting_1"> <?php echo $i++; ?></td>
<td><?php echo $row['ord_id']; ?></td>
<td><?php echo $row['spare_id']; ?></td>
<td><?php

$venid = $row['ventor_id'];

$vendtt = $db->queryUniqueObject("select * from vendor where id='$venid' ");
 echo $vendtt->name; ?></br>
Contact : <?php echo $vendtt->phone;?></br>
Email : <?php echo $vendtt->email;?>
</td>
<td><?php echo $row['pro_price']; ?></td>
<td><?php echo $row['status'];?></td>
<td>
    <?php $status = $row['status']; ?>
    <button class="btn btn-info btn-sm" data-toggle="modal" data-target=".orderedit<?php echo $row['id']; ?>"> Update<i class="fa fa-pencil"></i></button>

 <div class="modal fade orderedit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Update Process</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                         <form action="process.php" method="POST">

                                                              <div class="modal-body">
                                                         <input type="hidden" name="orderid" value="<?php echo $row['ord_id']; ?>"> 

                                                    <div class="form-group">
                                                    <label>Order Status</label>
                                                     
                                                      <select name="status">
<option value="process" class="bt btn-info" <?php if($status == 'process') { echo 'selected'; } ?>  >Process</option>
<option value="completed" class="btn btn-success" <?php if($tr == 'completed') { echo 'selected'; } ?>>Completed</option>
<option value="cancelled" class="btn btn-danger" <?php if($tr == 'cancelled') { echo 'selected'; } ?> >Cancelled</option>

                                                     </select>
                                                </div>
                                                <input type="hidden" name="prosid" value="<?php echo $row['id'];?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"  name="updateproposal" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>
                                                        
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    
<a href="delete.php?delprosal=<?php echo $row['id']; ?>&&action=1" class="btn btn-danger"  data-original-title="Edit"><i class="fa fa-trash"></i></a> 
   </td>
                                                 
                                                </tr>
                                                
<?php
}

?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>

                             </div>


<?php include("footer.php"); ?>


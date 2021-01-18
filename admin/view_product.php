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
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Product List</h3>
                                </div>
                                <div class="panel-body example_wrapper">
                                    <?php if(isset($_GET['msg'])){ ?> 
                                        <div class="alert alert-info">
                                            <strong>Info!</strong> <?=$_GET['msg'];?></div>
                                    <?php } ?>
                                    <table width="100%"  class="table convert-data-table table-striped" id="datatable">
                                            <thead> <tr>
                                           <th>Sno.</th>
<th>Name</th>
<th>Image</th>
<th>SKU</th>
<th>Price</th>
<th>Offer</th>
<th>Offer Price</th>
<th>Qty</th>
<th>Action</th>

</tr>
                                            </thead>
                                            <tbody>                         
                                                    <?php $scatview = $db->query("select * from products ORDER By product_id DESC ");
            $sno = 1;
            while($row1 = mysqli_fetch_array($scatview)){
            ?>
<tr role="row" class="even  <?php if($row1['stock']<=10){ echo 'danger'; } ?>">
<td><?php echo $sno++;  ?></td>
            <td><?php  echo $row1['name'];?></td>
            <td>
                <?php if($row1['img_path']==''){ ?>
<img src="../uploads/products/no_image.png" style="max-width:100px"/>
                <?php }else{ 
                    $imgs=json_decode($row1['img_path']);
                    ?>
<img src="../<?php echo $imgs[0];?>" style="max-width:100px"/>
                <?php } ?></td>
            <td><?php echo $row1['sku'];?></td>
            <td><?php echo $row1['price']; ?> </td>
            <td><?php echo $row1['offer']; ?></td>
            <td><?php echo $row1['final_price']; ?></td>
			<td><?php echo $row1['qty']; ?></td>  
        
         <td> 
            <a href="product-info.php?proid=<?=$row1['product_id']; ?>" class="m-r-15 text-muted  btn btn-success btn-sm"  data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="lnr lnr-eye font-18"></i></a>
            <a href="edit-product.php?proid=<?=$row1['product_id']; ?>" class="m-r-15 text-muted  btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="lnr lnr-pencil font-18"></i></a>
      <a href="javascript:void(0);" class="text-muted btn btn-danger btn-sm"  data-toggle="modal" data-target=".del<?php echo $row1[0]; ?>" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><i class="lnr lnr-trash font-18"></i></a>
 <div class="modal fade del<?php echo $row1[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h3 class="modal-title mt-0" id="mySmallModalLabel"><?php echo $row1['name']; ?></h3>
                                                                </div>
                                                              <div class="modal-body">
                                                            <p>Are You sure you want to Delete this Product </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <form action="delete.php" method="POST">
                                                        <input type="hidden" name="proid" value="<?php echo $row1[0]; ?>"> 
                                                            <button type="submit"  name="deleteproduct" class="btn btn-primary">Yes</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            </form>
                                                        </div>                                                  
                                                            </div> <!-- /.modal-content -->
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
<?php include("footer.php"); ?>


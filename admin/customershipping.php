<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
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
                                        Order List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                     <table width="100%"  class="table convert-data-table table-striped " >
										<thead>
                                                <tr role="row">
												<th>S.no</th>
                                                <th>Invoice No:</th>
												<th>Invoice Date:</th>
                                                <th >Customer Order</th>
                                                <th>View Invoice</th>
												<th>RTGS/NEFT Ref.No</th>
												<th>RTGS/NEFT Date</th>											
												<th>Payment Status</th>
												<th>Cust.status</th>
                                                </thead>
                                                <tbody> 

<?php    $cartlist = $db->query("SELECT * FROM `customer_proforma`  where payment_request='approved' group BY `customer_proforma`.`cust_order`,`customer_proforma`.`grouping` order by time ASC"); 
$olist=1;
 while ($orderlist = mysqli_fetch_array($cartlist)) {
	 
	 // print_r($orderlist);
?>

                        <tr role="row" class="odd">
                        <td class="sorting_1"> <?php echo $olist; ?></td>
					    <td class="sorting_1"> <?php echo $orderlist['invoice_number']; ?></td>	
						<td class="sorting_1"> <?php echo $orderlist['time']; ?></td>	
						<td class="sorting_1"> <?php echo $orderlist['cust_order']; ?></td>	
						<td class="sorting_1">						
						  <?php
  $orde_id= $db->query("SELECT * FROM `customer_proforma` WHERE invoice_number='$orderlist[invoice_number]' AND cust_order='$orderlist[cust_order]'"); 
  $ab=array();
  while($r1=mysqli_fetch_array($orde_id)){ 
  $ab[]=$r1['proposed_item_qty_id'];
  }
  $ab=implode(',',$ab);?>
  
  <a href="customer_proforma.php?id=<?=$ab; ?>&corder=<?=$orderlist['cust_order']; ?>&invoice_no=<?=$orderlist['invoice_number']; ?>" target="_blank">Invoice</a>
  </td>	
  <td class="sorting_1"> <?php echo $orderlist['neft_ref_no']; ?></td>
  <td class="sorting_1"> <?php echo $orderlist['neft_ref_date']; ?></td>
  <td class="sorting_1"> <?php echo $orderlist['payment_status']; ?></td>
  <td class="sorting_1"> <?php echo $orderlist['delivery_status']; ?></td>
  <td class="sorting_1"> <button class="btn btn-info btn-sm" data-toggle="modal" data-target=".trackedit<?php echo $orderlist['id']; ?>"> <i class="fa fa-pencil"></i></button>

 <div class="modal fade trackedit<?php echo $orderlist['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Order Tracking</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                         <form name="payment" method="POST">

                                                              <div class="modal-body">
                                                         <input type="hidden" name="orderid" value="<?php echo $orderlist[0]; ?>"> 
														 
														 <div class="form-group">
													<input type="hidden" name="invoice_number" class="form-control" value="<?=$orderlist['invoice_number'];?>">
													<input type="hidden" name="order_number" class="form-control" value="<?=$orderlist['cust_order'];?>">
													<div class="col-md-6">
													<label style="display:block;">Provider</label>
													<input type="text" name="provider" class="form-control" value="<?=$orderlist['shipping_provider'];?>">
													</div>
													<div class="col-md-6">
													<label style="display:block;">Shipped Date</label>
													<input type="date" name="shipped_date" class="form-control" value="<?=$orderlist['shipped_date'];?>">
													</div>													
													<div class="col-md-6">
													<label style="display:block;">Tracking Number</label>
													<input type="text" name="track_number" class="form-control" value="<?=$orderlist['tracking_provider'];?>" required>
													</div>
													<div class="col-md-6">
													<label style="display:block;">Estd. Delivery Date</label>
													<input type="date" name="delivery_date" class="form-control" value="<?=$orderlist['estd_delivery_date'];?>">
													</div>
													<div class="col-md-6">
													<label style="display:block;">Status</label>
													<select name="delivery_status" class="form-control" required>
													<option disabled selected value>Select Status</option>
													<option value="Shipped" <?php if($orderlist['delivery_status']=='Shipped'){?>selected <?php } ?>>Shipped</option>
													</select>
													</div>
													
													<div class="col-md-6">
													<label style="display:block;">DC Number</label>
													<input type="text" name="dcnumber" class="form-control" value="<?=$orderlist['dcnumber'];?>">
													</div>
													<div class="col-md-6">
													<label style="display:block;">E-way Bil No.</label>
													<input type="text" name="ebilno" class="form-control" value="<?=$orderlist['ebilno'];?>">
													</div>
													<div class="col-md-6">
													<label style="display:block;">E-way Bil Date</label>
													<input type="date" name="ebildate" class="form-control" value="<?=$orderlist['ebildate'];?>">
													</div>
													<div class="col-md-6">
													<label style="display:block;">Distance</label>
													<input type="text" name="distance" class="form-control" value="<?=$orderlist['distance'];?>">
													</div>
													</div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"  name="courier_update" class="btn btn-primary">Save</button>
                                                            <button  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
															</form>
                                                        </div>
														
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
	</td>
						</tr> 

                                                <?php $olist++;
												?>
  <?php } ?>
		 						</tbody>
                                            </table>


                                    


                                    </div>
                                </section>
                            </div>

                             </div>

<?php if(isset($_POST['courier_update'])){

	$db->query("UPDATE customer_proforma SET shipping_provider='$_POST[provider]',tracking_number='$_POST[track_number]',shipped_date='$_POST[shipped_date]',estd_delivery_date='$_POST[delivery_date]',delivery_status='$_POST[delivery_status]',dcnumber='$_POST[dcnumber]',ebilno='$_POST[ebilno]',ebildate='$_POST[ebildate]',distance='$_POST[distance]' WHERE invoice_number='$_POST[invoice_number]' AND cust_order='$_POST[order_number]'");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error while adding .. ')
    window.location.href='customershipping.php';
    </SCRIPT>");
}if(isset($_POST['add_payment'])){
	$db->query("UPDATE customer_proforma SET neft_ref_no='$_POST[neftref]', neft_ref_date='$_POST[neftrefdate]' ,payment_status='paid',delivery_status='$_POST[delivery_status]' WHERE id='$_POST[orderid]'");
	// echo "UPDATE customer_proforma SET neft_ref_no='$_POST[neftref]', neft_ref_date='$_POST[neftrefdate]' ,payment_status='paid',delivery_status='Packing' WHERE id='$_POST[orderid]'";
}?>

<?php include("footer.php") ?>
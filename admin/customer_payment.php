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
                                                <th>Customer Order</th>
                                                <th>View Invoice</th>
												<th>Request Status</th>
                                                </thead>
                                                <tbody> 

<?php    $cartlist = $db->query("SELECT * FROM `customer_proforma` group BY `customer_proforma`.`cust_order`,`customer_proforma`.`grouping` order by time Desc"); 
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
  <td><form method="post"><input type="hidden" name="inv_no" value="<?php echo $orderlist['invoice_number']; ?>">
  <?php if($orderlist['payment_request']== 'approved'){ ?>
	   <input type="submit" value="Decline" name="cancel_req_payment" class="btn btn-danger" <?php if($orderlist['delivery_status']!=''){ ?>disabled <?php } ?>>
  <?php }else{ ?>
	  <input type="submit" value="Approve" name="send_req_payment" class="btn btn-success" <?php if($orderlist['delivery_status']!=''){ ?>disabled <?php } ?>>
  <?php } ?>
  </form> </td>
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

	$db->query("UPDATE customer_proforma SET shipping_provider='$_POST[provider]',tracking_number='$_POST[track_number]',shipped_date='$_POST[shipped_date]',estd_delivery_date='$_POST[delivery_date]',delivery_status='$_POST[delivery_status]' WHERE invoice_number='$_POST[invoice_number]' AND cust_order='$_POST[order_number]'");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error while adding .. ')
    window.location.href='customer_payment.php';
    </SCRIPT>");
}  else if(isset($_POST['send_req_payment'])){
	$db->query("UPDATE customer_proforma SET payment_request='approved' WHERE invoice_number='$_POST[inv_no]'");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customer_payment.php';
    </SCRIPT>");
} else if(isset($_POST['cancel_req_payment'])){
	$db->query("UPDATE customer_proforma SET payment_request='decline' WHERE invoice_number='$_POST[inv_no]'");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='customer_payment.php';
    </SCRIPT>");
}?>

<?php include("footer.php") ?>
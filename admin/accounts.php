<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>


<table width="100%"  class="table table-striped " >
										<thead>
                                                <tr role="row">
												<th>S.no</th>
												<th>Cust.Order Id</th>
                                                <th>Ven.Id</th>
												<th>Ven.Name</th>
												<th>Ven.Order Id</th>
												<th>Material Rec.No</th>
												<th>Payment Type</th>
												<th>Invoice Inc.Gst</th>
												<th>Prof.Invoice Date</th>
												<th>Requested By</th>
												<th>Requested On</th>
												<th>Prof.Invoice</th>
												<th>Priority</th>
												<th>RTGS/NEFT Ref.No</th>
												<th>Bank Attachment</th>
												<th>Status</th>
												<th>Cust.status</th>
												<th>Action</th>
												</tr>
                                                </thead>
                                                <tbody> 
<?php $r=$db->query("SELECT * FROM vendor_proforma_payment_approve where status='Approved' order by approve_req_time DESC");

// SELECT a.*,b.* FROM proposed_items_qty a,vendor_proforma_payment_approve b LEFT JOIN vendor_proforma_payment_approve ON proposed_items_qty.vendor_order_id=vendor_proforma_payment_approve.v_order_id AND vendor_proforma_payment_approve.status='Approved'
$i=0;
while($row=mysqli_fetch_array($r)){ 
$i++;
// echo '<pre>';
// print_r($row);
// echo '</pre>';
$order=mysqli_fetch_array($db->query("SELECT * FROM proposed_items_qty WHERE vendor_order_id = '$row[v_order_id]'"));
$vendor=mysqli_fetch_array($db->query("SELECT * FROM vendor WHERE id = '$order[ventor_id]'"));
$vendor_proforma_detail=mysqli_fetch_array($db->query("SELECT * FROM vendor_proforma_detail WHERE vend_order_id = '$order[vendor_order_id]'"));
// print_r($vendor_proforma_detail);
?>

<tr role="row" class="odd">
                        <td class="invert-closeb"><?=$i++; ?></td>
						<td class="invert-closeb"><?=$order['customer_ord_id'] ?></td>
						<td class="invert-closeb"><?=$vendor['vendorid'] ?></td>
						<td class="invert-closeb"><?=$vendor['name'] ?></td>
						<td class="invert-closeb"><?=$row['v_order_id'] ?></td>
						<td class="invert-closeb"><?=$order['payment_receipt'] ?></td>
						<td class="invert-closeb"><?=$vendor['payment_type'] ?></td>
						<td class="invert-closeb"><?=$vendor['payment_type'] ?></td>
						<td class="invert-closeb"><?=$row['total_price'] ?></td>
						<td class="invert-closeb"><?=$order['invoice_date'] ?></td>
						<td class="invert-closeb"><?=$row['update_by'] ?></td>
						<td class="invert-closeb"><?=$row['approve_req_time'] ?></td>
						<td class="invert-closeb"><?=$vendor['credit_date'] ?></td>
						<td class="invert-closeb"><?=$row['neft_ref_no'] ?></td>
						<td class="sorting_1"><?php if($row['bank_proof']!=''){ ?><a href="<?php echo $row['bank_proof']; ?>" download>Preview</a><?php } ?></td>
						<td class="invert-closeb"><?=$row['payment_status'] ?></td>
						<td class="invert-closeb"><?=$row['cust_delivery_status'] ?></td>
						<td class="invert-closeb">
						<a href="updateaccount.php?getid=<?php echo $row['id'];?>" class="btn btn-primary">update</a></td>
</tr>
<?php }
?>
	</tbody>	
</table>	


<?php include("footer.php"); ?>
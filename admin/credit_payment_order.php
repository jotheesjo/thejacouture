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
                                        Order List
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                   <!-- Payment approvement -->
<h3>Credit Payment</h3>	
		<table width="100%"  class="table table-striped " >
										<thead>
                                                <tr role="row">
												<th>S.no</th>
												<th>Material Receipt.No</th>
												<th>Receipt Date</th>
												<th>Customer Order</th>
                                                <th>Vendor Id</th>
												<th>Vendor Name</th>
												<th>Vendor Order</th>
												<th>Vendor Credit Days</th>
												<th>Invoice No</th>
												<th>Invoice Date</th>
												<th>Invoice Inc.Gst</th>
												<th>Approve</th>
												</tr>
                                                </thead>
                                                <tbody> 
<?php
$r1=$db->query("select a.*,b.* from vendor a,proposed_items_qty b WHERE a.payment_type='against credit' AND b.ventor_id=a.id AND b.sf_approve_qty!='0' order by b.vendor_order_id DESC");
$j=0;
while($row=mysqli_fetch_array($r1)){
	$j++;
$vendor_price=mysqli_fetch_array($db->query("select * from vendor_parts WHERE tr_id='$row[ventor_id]' AND pro_id='$row[spare_id]'"));

 $gst=mysqli_fetch_array($db->query("SELECT * FROM products where id='$row[spare_id]'"));
 $cust_order_id=mysqli_fetch_array($db->query("select * from proposed_items WHERE vendor_order_id='$row[vendor_order_id]' AND ventor_id='$row[ventor_id]'"));
 
 $inc_gst=($row['sf_approve_qty']*$vendor_price['discount_price'])+(($row['sf_approve_qty']*$vendor_price['discount_price'])*($gst['gst']/100));
 
  $status=mysqli_fetch_array($db->query("select count(*) as stat from vendor_proforma_payment_approve WHERE v_order_id='$row[vendor_order_id]' AND status='Approved' AND ref='$row[payment_receipt]'"));
?>
<tr role="row" class="odd">
                        <td class="invert-closeb"><?=$j;?></td>
						<td class="invert-closeb"><?=$row['payment_receipt'];?></td>
						<td class="invert-closeb"><?=$row['payment_date'];?></td>
						<td class="invert-closeb"><?=$cust_order_id['ord_id'];?></td>
						<td class="invert-closeb"><?=$row['vendorid'];?></td>
						<td class="invert-closeb"><?=$row['name'];?></td>
						<td class="invert-closeb"><?=$row['vendor_order_id'];?></td>
						<td class="invert-closeb"><?=$row['credit_date'];?></td>
						<td class="invert-closeb"><?=$row['invoice_num'];?></td>
						<td class="invert-closeb"><?=$row['invoice_date'];?></td>
						<td class="invert-closeb"><?php echo $inc_gst;?></td>
						<td class="invert-closeb">
						<?=$row['credit_payment_status'];?><br/>  
						<form method="post" action="">
						<input type="hidden" value="<?=$row['vendor_order_id'];?>" name="vordid">
						<input type="hidden" value="<?=$row['id'];?>" name="vid">
						<input type="hidden" value="<?=$inc_gst;?>" name="inc_gst">
						<input type="hidden" value="<?=$row['payment_receipt'];?>" name="ref">
						
						<?php if($status['stat'] == 1){ ?>
							<input type="submit" name="decline" class="btn btn-danger" value="Decline">
						<?php }else if($status['stat'] == 0){?>
						<input type="submit" name="accept" class="btn btn-success" value="Accept">
						<?php } ?>
						</form>
						</td>
</tr>
<?php } ?>
	</tbody>	
</table>
                                    


                                    </div>
                                </section>
                            </div>

                             </div>

<?php 
if(isset($_POST['accept'])){

	$db->query("INSERT INTO vendor_proforma_payment_approve (total_price,v_order_id,v_id,approve_req_time,status,type,ref) VALUES ('$_POST[inc_gst]','$_POST[vordid]','$_POST[vid]',NOW(),'Approved','credit','$_POST[ref]')");
	
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.location.href='credit_payment_order.php';
   </SCRIPT>");
}else if(isset($_POST['decline'])){
	// $db->query("INSERT INTO vendor_proforma_payment_approve (total_price,v_order_id,v_id,approve_req_time,status,type) VALUES ('$_POST[inc_gst]','$_POST[vordid]','$_POST[vid]',NOW(),'Decline','credit')");
	$db->query("UPDATE `vendor_proforma_payment_approve` SET `status` = 'Decline' WHERE v_order_id='$_POST[vordid]' AND ref='$_POST[ref]'");
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='credit_payment_order.php';
    </SCRIPT>");
}
?>


<?php include("footer.php"); ?>
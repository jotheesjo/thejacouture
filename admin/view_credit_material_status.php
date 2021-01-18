<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<?php  $orderid = $_GET['getid']; ?>

<?php
$orderd = $db->queryUniqueObject("select * from orders where orders_id='$orderid' "); 
$cid = $orderd->cus_id;
$odate=  $orderd->date;
$ofname= $orderd->fname;
$olname =$orderd->lname;
$oemail = $orderd->email;
$ophone= $orderd->phone;
$oaddress =$orderd->address;
$ocity = $orderd->city;
$opin = $orderd->pin;
$onot = $orderd->notes;
$ot = $orderd->trach;
$expdate= $orderd->expdate;
$cusdd = $db->queryUniqueObject("select * from users where id='$cid' "); 
$cusdd->name;
$cusdd->contact;
?> 
<?php 
if(isset($_POST['receivepro'])){
	$ins=$db->query("UPDATE proposed_items SET received_qty = '$_POST[receive_qty]', remarks = '$_POST[remarks]' WHERE spare_id='$_POST[spareid]' AND vendor_order_id='$_POST[orderid]' AND ventor_id='$_POST[vendorid]'");
	
	if ($ins) {
    
          echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully  Assigned  .. ')
    window.location.href='vendor_orders.php';
    </SCRIPT>");
    }
    else {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='vendor_orders.php';
    </SCRIPT>");
    }   
	
}else if(isset($_POST['update_vendor_inv'])){
	$reject=$_POST['receive_qty']-$_POST['approve_qty'];
$inss=mysqli_fetch_array($db->query("select sum(sf_approve_qty) as sfsum from proposed_items_qty where id <= '$_POST[row_id]' AND vendor_order_id='$_POST[vendor_order_id]' AND spare_id='$_POST[spare_id]' AND ventor_id='$_POST[ventor_id]'"));

$bb=($_POST['totassignqty'] - ($inss['sfsum']+$_POST['approve_qty']));
$payment_receipt =$_POST['row_id']+2000;
$payment_rec = 'R'.$payment_receipt;
if($_POST['payment_date']=='0000-00-00 00:00:00'){
	$payment_date=date("Y-m-d h:i:s");
}else{
	$payment_date = $_POST['payment_date'];
}

if($bb!=0){
	$status="partially Received";
}else{
	$status="Complete Received";
}
	$db->query("UPDATE proposed_items_qty SET sf_receive_qty='$_POST[receive_qty]',sf_approve_qty='$_POST[approve_qty]',sf_reject_qty='$reject',remarks='$_POST[remarks]',remarks_time=NOW(),approve_time=NOW(),sf_receive_time='$_POST[receive_date]',vendor_dc_num='$_POST[dc_no]',vendor_dc_date='$_POST[dc_date]',invoice_num='$_POST[invoice_no]',invoice_date='$_POST[invoice_date]',status='$status', payment_receipt='$payment_rec',payment_date='$payment_date',proforma_status='$_POST[proforma_status]' WHERE customer_ord_id='$_POST[customer_ord_id]' AND vendor_order_id='$_POST[vendor_order_id]' AND spare_id='$_POST[spare_id]' AND ventor_id='$_POST[ventor_id]' AND id='$_POST[row_id]' ");
}
?>


<div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-block">

                                            <h4 class="mt-0 header-title">Track Vendor</h4>
<a href="view_orders.php"> <button class="btn btn-primary">Back</button></a>

<div class="panel">
  <div class="panel-heading">Order Details  <br>
<h3>ORDER ID : <?php echo $orderid;?>  </h3>
  </div> 
    <div class="panel-body">


<!--<form action="process.php" method="post">-->
<div class="table-responsive">
    <input type="hidden" name="ordid" value="<?php echo $orderid;?>">


<?php 
 $proli = $db->query("select * from cart where orders_id='$orderid' and status='cartord' "); 
 $csumofvalue  ='';
 $con = 1; 
 $slno=1;
 $pr=1;
 while ($ss = mysqli_fetch_array($proli)) {

    $cpid  = $ss['pro_id']; 

     $prodtt = $db->queryUniqueObject("select * from products where id='$cpid' ");
     $progst =  $prodtt->gst;
?>

<input type="hidden" name="proid[]" value="<?php  echo $cpid; ?>">



<table class="table">
 <tr> 
 <th>Sl.No</th> <th>image</th><th>Product ID</th>
 <th>Product Name</th><th>Order Qty</th>
 <th>Price/Qty</th> <th>Gst</th> <th>Total Price</th>
 <th>To be delivered</th>
  </tr>
  <tr style="color: orange;" >  <td> <?php echo $slno++; ?>. </td></td><td><img src="<?=$prodtt->image; ?>" style="width: 50px;height: 50px;" /></td> <td><?php  echo $prodtt->partid;?></td> <td><?php  echo $prodtt->partid;?></td>     <td><?php echo $ss['qty'] ?></td> <td><?php echo $orprice=  $ss['price'] ?>/qty</td><td><?php echo $progst;  $prate =  ($orprice*$progst)/100;  ?>%</td><td><?php echo $tot=$prate+$orprice;   ?></td> <td><?=$expdate; ?></td>  </tr>

</table>



<table class="table" BORDERCOLOR="orange">
  <tr><th>Ven ID</th> <th>Ven Name</th><th>Part ID</th><th>Basic Price</th><th>Disc %</th>
  <th>Dis. price</th><th>Rdy Stock</th><th>Gst</th><th>Total</th> <th>Profit</th><th>Assiged qty</th><th>Vendor Order Id</th><th>send by vendor</th><th>Received by SF</th><!--<th>Remarks</th><th>Assign</th>--> </tr>
<?php  
 $partv = $db->query("select * from vendor_parts where pro_id='$cpid' "); 
 while ($pv = mysqli_fetch_array($partv)) {
   $venid =  $pv['tr_id'];
   $ppid =  $pv['pro_id'];

   $amt =  $pv['amt'];
   $discount =  $pv['discount'];
   $discount =  $pv['discount'];
   $ven_qty =  $pv['qty']; 

   $proposerdparts=$db->query("select * from proposed_items where ord_id='$orderid' AND spare_id='$prodtt->id' AND ventor_id='$venid'");
    while ($proposerdparts = mysqli_fetch_array($proposerdparts)) {
   
    $vendtt = $db->queryUniqueObject("select * from vendor where id='$venid' ");
if($ppid == '') { echo '<b>No vendors available for this part ID</b><br>'; } else {
?>


<tr id="vendorlist">
  <td><?php echo $vendtt->vendorid; ?></td><td><?php echo $vendtt->name; ?></td><td><?php  echo $prodtt->partid;?></td> <td><?php echo $amt; ?></td><td><?php echo $discount; ?></td><td> <?php $disamt = $amt-(($amt*$discount)/100);  echo  $disamt; ?></td><td><?=$ven_qty; ?></td><td><?php echo $progst.'%';  $vprate =  ($venprice*$progst)/100;  ?></td><td> <?=$grant=$disamt+(($disamt*$progst)/100); ?></td> <!--<td>0</td> <td>0</td><td>1 day</td> <td><?=$prodtt->gst; ?></td><td>nn</td><td>2%</td>--><td><?=$profit=$tot-$grant; ?>/qty</td>
  <td>
  <?php echo $proposerdparts['assign_qty'];?>
  </td>
    <td>
  <?php echo $proposerdparts['vendor_order_id'];?>
  </td>
  <td>
  <?php echo $proposerdparts['send_qty'];?>
  </td>
    <td>
  <?php echo $proposerdparts['received_qty'];?>
  </td>
  <!--<td>
  <?php echo $proposerdparts['remarks'];?>
  </td>
  <td>
  <form method="post" action="">
  <input type="number" name="receive_qty" required="required" placeholder="Received items">
  <input type="hidden" name="orderid" value="<?=$proposerdparts['vendor_order_id'] ?>">
  <input type="hidden" name="vendorid" value="<?=$venid; ?>">
  <input type="hidden" name="spareid" value="<?=$proposerdparts['spare_id'] ?>">
  <input type="text" name="remarks" placeholder="remarks">
<input type="submit" class="btn btn-primary" name="receivepro" value="Submit">
</form>
  </td>-->
</tr>
 <?php } } }  ?> 
</table>

	 
<table class="table" BORDERCOLOR="lightgreen">
<tr><th>Ven Id</th><th>Vendor dc reference</th> <th>Vendor dc date</th><th>Vendor invoice Number</th><th>Vendor invoice date</th><th>Payment Receipt</th><th>Payment Date</th><th>Received Qty</th><th>Received ON</th><th>Send by vendor Qty</th><th>Balance Qty</th><th>Approved Qty</th><th>Rejection Qty</th> <th>Status</th><th>Make Payment to Vendor</th><th>Customer mode of payment</th><th>send by vendor</th><th>Remarks</th><th>Assign</th> <th></th></tr>
<?php 
$invtrack = $db->query("select * from proposed_items_qty where customer_ord_id='$orderid' AND spare_id='$prodtt->id' ");
$i=1;
$j=1;
  while ($inv = mysqli_fetch_array($invtrack)) { ?>
<?php $i++;
$j++; ?>
<?php $order_qty = $db->queryUniqueObject("select assign_qty from proposed_items where ord_id='$inv[customer_ord_id]' AND spare_id='$inv[spare_id]' AND vendor_order_id='$inv[vendor_order_id]' "); 
 ?>
<?php $ven=mysqli_fetch_array($db->query("select assign_qty from proposed_items where ord_id='$orderid' AND spare_id='$prodtt->id' AND ventor_id='$inv[ventor_id]'"));
 ?>
<tr id="vendorlist">

<form method="post" action="">
<td><?=$inv['vendor_order_id']; ?></td>
<td><?=$inv['vendor_dc_num']; ?><br /><input type="text" name="dc_no"  class="form-control tog<?=$i;?>" value="<?=$inv['vendor_dc_num']; ?>" style="display: none;"></td>
<td><?=$inv['vendor_dc_date']; ?><br /><input type="date" name="dc_date" class="form-control tog<?=$i;?>" value="<?=$inv['vendor_dc_date']; ?>" style="display: none;"></td>
<td><?=$inv['invoice_num']; ?><br /><input type="text" name="invoice_no" class="form-control tog<?=$i;?>" value="<?=$inv['invoice_num']; ?>" style="display: none;"></td>
<td><?=$inv['invoice_date']; ?><br /><input type="date" name="invoice_date" class="form-control tog<?=$i;?>" value="<?=$inv['invoice_date']; ?>" style="display: none;"></td>
<td><?=$inv['payment_receipt']; ?><br /></td>
<td><?=$inv['payment_date']; ?><br /></td>
<td><?=$inv['sf_receive_qty']; ?><br /><input type="text" name="receive_qty" class="form-control tog<?=$i;?>" value="<?=$inv['sf_receive_qty']; ?>" style="display: none;"></td>
<td><?=$inv['sf_receive_time']; ?><br /><input type="date" name="receive_date" class="form-control tog<?=$i;?>" value="<?=$inv['sf_receive_time']; ?>" style="display: none;"></td>
<td><?=$inv['ven_send_qty']; ?></td>
<td></td>
<td><?=$inv['sf_approve_qty']; ?><br /><input type="text" name="approve_qty" class="form-control tog<?=$i;?>" value="<?=$inv['sf_approve_qty']; ?>" style="display: none;"></td>
<td><?=$inv['sf_reject_qty']; ?></td>
<td><?=$inv['status']; ?></td>
<td></td>
<td><?php if($inv['proforma_status'] =='notreceived'){
	if (isset($_REQUEST['email']))  {
		$to = 'jothees.clouddreams@gmail.com';
$subject = "Reminder For Proforma";

$headers = "From: info@sparefactory \r\n";
$headers .= "Reply-To: info@sparefactory \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h3>greetings from Sparefactory</h3><br/>
<p>We are waiting for your proforma for this order:'.$inv['vendor_order_id'].'</p><br />
<table style="border: 1px solid black;"><tr><th style="border: 1px solid black;">Vendor dc reference</th><td style="border: 1px solid black;">'.$inv['vendor_dc_num'].'</td></tr>
<tr><th style="border: 1px solid black;">Send by vendor Qty</th><td style="border: 1px solid black;">'.$inv['ven_send_qty'].'</td></tr>
<tr><th style="border: 1px solid black;">Status</th><td style="border: 1px solid black;">'.$inv['status'].'</td></tr></table>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
	} ?>
	<!--<form method="post">
	<input type="submit" name="email" class="btn btn primary" value="Reminder Proforma">
	
	</form>-->
	<a href="track_assign_vendor.php?getid=<?= $orderid; ?>&email=<?=$inv['id']; ?>" class="btn btn-primary">Send Reminder</a>
<?php }else if($inv['proforma_status'] =='received'){ ?>
	<a href="generate_vendor_proforma.php?getid=<?= $orderid; ?>&vorderid=<?=$inv['id']; ?>" class="btn btn-primary">Generate Proforma</a>
<?php } ?><br /><select name="proforma_status" class="form-control tog<?=$i;?>"  style="display: none;">
<option value="received">Received</option>
<option value="notreceived">Not Received</option>
</select></td>
<td>4</td>
<td></td>
<td><?=$inv['remarks']; ?><br /><input type="text" name="remarks" class="form-control tog<?=$i;?>" value="<?=$inv['remarks']; ?>" style="display: none;"></td>
<td>
<input type="hidden" name="row_id" value="<?=$inv['id']; ?>">
<input type="hidden" name="customer_ord_id" value="<?=$inv['customer_ord_id']; ?>">
<input type="hidden" name="vendor_order_id" value="<?=$inv['vendor_order_id']; ?>">
<input type="hidden" name="spare_id" value="<?=$inv['spare_id']; ?>">
<input type="hidden" name="ventor_id" value="<?=$inv['ventor_id']; ?>">
<input type="hidden" name="totassignqty" value="<?=$ven['assign_qty']; ?>">
<input type="hidden" name="payment_date" value="<?=$inv['payment_date']; ?>">
<input type="submit" name="update_vendor_inv" class="btn btn-default tog<?=$i;?>" style="display: none;">
</td>
</form>
<script>
$(document).ready(function(){
    $("#togs<?=$j;?>").click(function(){
        $(".tog<?=$i;?>").toggle();
    });
});
</script>
 <?php  } ?>

</tr>	
  </table>
 <?php   }  ?> 
</div>




<style type="text/css">  
  #vendorlist{
  background: #f9882852;
}

</style>
<!--<p align="right">    <button class="btn btn-primary" name="submitval" value="1">Send </button> </p>

</form>-->



    </div>
</div>

							<?php include("footer.php") ?>
							
							
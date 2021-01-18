<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>
<?php $id=$_GET['getid'];?>

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
                          Payment List
                     <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>

									
									
                                    <div class="panel-body">										
									
						<form method="post" action="" enctype = "multipart/form-data">
						<div class="form-group">
	<div class="col-xs-6">
	<input type="hidden" name="id" class="form-control" value="<?=$id; ?>">
	<label for="email">RTGS/NEFT Reference.No:</label>
    <input type="text" name="neftref" class="form-control" required="required">
	</div>
  </div>
  <div class="form-group">
	 <div class="col-xs-6">
    <label for="email">RTGS/NEFT Reference Date:</label>
    <input type="date" name="neftrefdate" class="form-control" required="required">
	</div>  
	</div>
	<div class="form-group">
    <div class="col-xs-6">
    <label for="email">Bank Mail Attachment:</label>
    <input type="file" name="image" class="form-control" required="required">
	</div>
  </div>
  <!--<div class="form-group">
    <div class="col-xs-6">
    <label for="email">Status:</label>
	<select name="shipping" class="form-control" required>
	<option disabled selected value>--select--</option>
	<option value="readytopack">Move to Packing</option>
	</select>
	</div>
  </div>-->
   <div class="col-xs-6">
   <br/>
    <input type="submit" class="btn btn-primary" value="Add Payment Receipt" name="add_payment">
</div>
	</form>	
<br/>
<br/>
 </div>
                                </section>
                            </div>

                             </div>

<?php if(isset($_POST['add_payment'])){
	 if(isset($_FILES['image'])){
	  $errors= array();
	 $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $expensions= array("jpeg","jpg","png","pdf","doc","docx");
	   if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
	   if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
	   if(empty($errors)==true) {
		   $tt="uploads/payment/".rand(1,100000).$id.'.'.$file_ext;
         move_uploaded_file($file_tmp,$tt);
		 
		 $db->query("UPDATE vendor_proforma_payment_approve SET neft_ref_no='$_POST[neftref]',neft_ref_date='$_POST[neftrefdate]',bank_proof='$tt',payment_status='paid' WHERE id='$_POST[id]'");
        // echo "Success";
      }else{
         print_r($errors);
      }
   }
}?>




		<table width="100%"  class="table table-striped " >
										<thead>
                                                <tr role="row">
												<th>S.no</th>
												<th>Cust.Order Id</th>
                                                <th>Ven.Id</th>
												<th>Ven.Name</th>
												<th>Ven.Oredr Id</th>
												<th>Payment Type</th>
												<th>Invoice Inc.Gst</th>
												<th>Prof.Invoice Date</th>
												<th>Requested By</th>
												<th>Requested On</th>
												<th>Prof.Invoice</th>
												<th>Priority</th>
												<th>RTGS/NEFT Ref.No</th>
												<th>Bank Attachment</th>
												<th>Payment Status</th>
												<th>Mail to Vendor</th>
												<th>Action</th>
												</tr>
                                                </thead>
                                                <tbody> 
<?php $r=$db->query("SELECT * FROM vendor_proforma_payment_approve where id='$id' ");

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

?>
  <?php	if (isset($_REQUEST['emailrem']))  {
		$to = 'jothees.clouddreams@gmail.com';
$subject = "Confirmation for the order";

$headers = "From: info@sparefactory \r\n";
$headers .= "Reply-To: info@sparefactory \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h3>Greetings from Sparefactory</h3><br/>
<p>We happy to inform you the, we successfully send the payment to Your account <b>Ref.No</b>:'.$row['neft_ref_no'].'</p><br />
<table style="border: 1px solid black;"><tr><th style="border: 1px solid black;">Neft Date</th><td style="border: 1px solid black;">'.$row['neft_ref_date'].'</td></tr>
<tr></tr></table>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
echo("<SCRIPT LANGUAGE='JavaScript'>
   window.alert('Successfully mail Send.. ')
   window.location.href='updateaccount.php?getid=$id';
   </SCRIPT>");
	} ?> 
<tr role="row" class="odd">
                        <td class="invert-closeb"><?=$i++; ?></td>
						<td class="invert-closeb"><?=$order['customer_ord_id'] ?></td>
						<td class="invert-closeb"><?=$vendor['vendorid'] ?></td>
						<td class="invert-closeb"><?=$vendor['name'] ?></td>
						<td class="invert-closeb"><?=$row[v_order_id] ?></td>
						<td class="invert-closeb"><?=$vendor['payment_type'] ?></td>
						<td class="invert-closeb"><?=$row['total_price'] ?></td>
						<td class="invert-closeb"><?=$order['invoice_date'] ?></td>
						<td class="invert-closeb"><?=$row['update_by'] ?></td>
						<td class="invert-closeb"><?=$row['approve_req_time'] ?></td>
						<td class="invert-closeb"><?=$vendor_proforma_detail['receipt_no'] ?></td>
						<td class="invert-closeb"></td>
						<td class="invert-closeb"><?=$row['neft_ref_no'] ?></td>
						<td class="sorting_1"><?php if($row['bank_proof']!=''){ ?><a href="<?php echo $row['bank_proof']; ?>" download>Preview</a><?php } ?></td>
						<td class="invert-closeb"><?=$row['payment_status'] ?></td>
						<td class="invert-closeb">
						<form method="post" action="">
						<input type="hidden" name="email" value="q">
						<input type="submit" class="btn btn-primary" value="Send Mail" name="emailrem">
						</form>
						</td>
						<td class="invert-closeb">
						<a href="updateaccount.php?getid=<?php echo $row['id'];?>" class="btn btn-primary">update</a></td>
</tr>
<?php }
?>
	</tbody>	
</table>	

<?php include("footer.php"); ?>
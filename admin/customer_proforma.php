<?php include("header.php") ?>
<?php include("nav_bar.php") ?>
<?php include("nav_left.php") ?>
<?php $vorders= $_GET['id']; 
$corders= $_GET['corder']; 
$invoice_no= $_GET['invoice_no'];
?>
<?php $proposed_item=$db->query("select *,sum(sf_approve_qty) as qty FROM proposed_items_qty WHERE id IN($vorders) group by spare_id");

$corderdetail=$db->queryUniqueObject("select * from orders where orders_id='$corders'");
$cust_payment_type=$db->queryUniqueObject("select * from users where id='$corderdetail->cus_id'");
?>
<div class="container  border border-primary panel panel-default" >
    <div class="row">
        <div class="col-xs-12">
		<h3>Order ID:<?=$corders; ?></h3>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
                        <strong>Billed To:</strong><br>
    					Company Name: <?php echo  $admind->name; ?> <br>
    					Email : <?php echo  $admind->email; ?> <br>
                        Adress : <?php echo  $admind->add1; echo '   '; echo  $admind->add2; ?> <br>
                        State : <?php  echo $admind->state; ?>
                         <br>
                        City : <?php echo  $admind->city; ?> <br>
                        Pin : <?php echo  $admind->pin; ?> <br>
                        Website : <?php echo  $admind->web; ?> <br>
    				</address>
    			</div>
				
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					<?php echo $corderdetail->fname; echo $corderdetail->lname; echo '<br>'; echo $corderdetail->address; echo '<br>'; echo $corderdetail->city; echo '<br>'; echo $corderdetail->state; echo '<br>'; echo $corderdetail->pin; echo '<br>'; echo $corderdetail->email; ?> 
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    			 
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					 <?php echo  $corderdetail->date; ?> <br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
   <form method="post">
             <table class="table table-bordered table-cart">
              <thead>
                <tr>
                  <th>Sno.</th>
                  <th>Part ID</th>
				  <th>Name</th>
				  <th>HSN</th>
                  <th>Quantity</th>
				  <th>UOM</th>
				  <th>price</th>
				  <th>SGST</th>
				  <th>CGST</th>
                  <th>IGST</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>

   <?php $i=0;
   $total_qty=array();
   $total_pric=array();
   $prod_qty=array();
   $cart_id=array();
while($row=mysqli_fetch_array($proposed_item)){ 
$order_price=$db->queryUniqueObject("select * from cart where orders_id='$corders' AND pro_id='$row[spare_id]' ");
$products_detail=$db->queryUniqueObject("select * from products where id='$row[spare_id]' ");

$i++;



?>             
          <tr class="rem1">
		  
            <td>
            <?php  echo $i; ?> 
           </td>
            <td class="invert"><?php echo $row['spare_name'];  ?></td>
			<td><?php echo $products_detail->sdesc;?></td>
			<td><?php echo $products_detail->hscn;?></td>
            <td>  <label><?php echo $cqty1 =$row['qty'];  ?> </label> </td>
			<td class="invert"><?php echo $products_detail->uom ?></td>
			<td class="invert"><?php echo $order_price->price ?></td>
            <td><?php if($admind->state == $corderdetail->state){
				echo (($products_detail->gst)/2).'%';
			}else{ echo '-';} ?></td>
			<td><?php if($admind->state == $corderdetail->state){
				echo (($products_detail->gst)/2).'%';
			}else{ echo '-';} ?></td>
			<td><?php if($admind->state == $corderdetail->state){
				echo '-';
			}else{ echo $products_detail->gst.'%';} ?></td>
			<td><?php echo $total=($order_price->price * $row['qty'])+(($order_price->price * $row['qty'])*$products_detail->gst/100); ?></td>
          </tr>
		 
<?php
$cart_id[]=$order_price->id;
$total_qty[]=$cqty1;
$total_pric[]=$total;
$prod_qty[]=$cqty1;
 } 
$prod_qty1=implode(',',$prod_qty);
$cart_id=implode(',',$cart_id);?>
<input type="hidden" value="<?php echo $prod_qty1; ?>" name="invoice_qty">
<input type="hidden" value="<?php echo $vorders; ?>" name="proposed_item_qty_id">
<input type="hidden" name="aa" value="<?php echo $corders ;?>">
<tr><td ></td><td ></td><td ></td><td ></td><td ></td>
  <td></td>
  <td>Total Qty :</td>
  <td ><?php echo $quantity=array_sum($total_qty); ?></td><td ></td>
   <td>Total Amount</td> <td><b>INR <?php echo $price=array_sum($total_pric); ?></b></td></tr>
            
              </tbody>
            </table>  
<?php if($invoice_no ==''){ ?>
	<input type="submit" name="confirm" value="Confirm Proposal" class="btn btn-primary">  
<?php } ?>
</form>			
    	</div>
    </div>
	
	<?php if($invoice_no !=''){ ?>
<div class="row">
    	<div class="col-md-5">

             <table class="table table-bordered table-cart">
                <tr><td>Account Name : </td><td></td></tr>
				<tr><td>Account Number:</td><td></td></tr>
				<tr><td>Bank </td><td></td></tr>
				<tr><td>Branch</td><td></td></tr>
				<tr><td>IFSC Code :</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>

</table>				
</div>

    	<div class="col-md-5">

             <table class="table table-bordered table-cart">	
			 <tr><td><b>Terms:</b><br/>
			 SUBJECT TO METTUPALAYAM JURISDICTION
KFMGKFMGMFDGMFDMG
GLDF;GLF;,MGL;FDGL,F;D
/.,FG,G,D,GFD
‘;FG;DLGDF</td></tr>
</table>				
</div>	

<div class="col-md-2">
For spares-factory.com
<br/><br/><br/><br/><br/><br/><br/><br/>
<p><b>Authorised Signatory</b></p>
</div>
	
</div>	
	<?php } ?>
</div>
<?php 
if(isset($_POST['confirm'])){
$sql = "";
if (!empty($_POST['proposed_item_qty_id']) && !empty($_POST['invoice_qty'])) {
    $productQtys = explode(",", $_POST['proposed_item_qty_id']);
    $cartIds = explode(",", $_POST['invoice_qty']);
	$inn = $db->maxOfAll("id","customer_proforma"); 
	$in=$inn+1000;
    $grouping = mysqli_fetch_array($db->query("select count(*) as grouping  from customer_proforma  where cust_order='$corders'"));
	//echo "select count(*) as grouping  from customer_proforma  where cust_order='$corders'";
	if($grouping['grouping']==0){
		$aa=1;
	}else{
		
		$a= mysqli_fetch_array($db->query("select max(grouping) as grouping from customer_proforma WHERE cust_order='$corders'"));
		$aa=$a['grouping']+1;
	}
	   //echo $aa;
	$inns='SF/'.date('Y').'/'.$in;
    foreach ($productQtys as $key => $value) {
        if (!empty($value)) {

            $cartId = isset($cartIds[$key]) ? $cartIds[$key] : 0;
         $sql = " INSERT INTO customer_proforma SET `invoice_qty` = $cartId ,`proposed_item_qty_id` = $value ,`time` = NOW() ,`invoice_number` = '$inns' , `cust_order` = $corders ,`grouping` = $aa";
			$db->query($sql);
        }
    }
$to = $corderdetail->email;
$subject = "Orders Proforma";

$headers = "From: info@sparefactory \r\n";
$headers .= "Reply-To: info@sparefactory \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h3>Greetings from Sparefactory</h3><br/>
<p>Your Order has been generated kindly check the order status in your account';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Generated Successfully')
    window.location.href='customer_proforma.php?id=".$vorders."&corder=".$corders."
    </SCRIPT>");
}

}
?>



<?php include("footer.php") ?>
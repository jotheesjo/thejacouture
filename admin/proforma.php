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
                                     <table width="100%"  class="table convert-data-table table-striped " >
										<thead>
                                                <tr role="row">
												<th>S.no</th>
                                                <th>Order No:</th>
                                                <th >Order Date</th>
                                                <th>Order Value</th>
												<th>Vendor Order ID</th>
												<th>Vendor Name</th>
												<th>Status</th>
												<th>Remainder E-mail</th>
                                                </thead>
                                                <tbody> 

<?php    $cartlist = $db->query("SELECT a.*,b.* from vendor a,proposed_items b WHERE a.id = b.ventor_id AND a.payment_type='against proforma' GROUP by vendor_order_id ORDER By b.order_date DESC"); 
$olist=1;
 while ($orderlist = mysqli_fetch_array($cartlist)) {
?>
  <?php	if (isset($_REQUEST['emailpi']))  {
		$to = 'jothees.clouddreams@gmail.com';
$subject = "Reminder For Proforma";

$headers = "From: info@sparefactory \r\n";
$headers .= "Reply-To: info@sparefactory \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h3>Greetings from Sparefactory</h3><br/>
<p>We are waiting for your proforma for this order:'.$orderlist['vendor_order_id'].'</p><br />
<table style="border: 1px solid black;"><tr><th style="border: 1px solid black;">Order Qty</th><td style="border: 1px solid black;">'.$orderlist['assign_qty'].'</td></tr>
<tr><th style="border: 1px solid black;">Status</th><td style="border: 1px solid black;">'.$orderlist['status'].'</td></tr></table>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
	} ?>       

                        <tr role="row" class="odd">
                        <td class="invert-closeb"> <?php  echo $olist++; ?> </td>
                        <td class="sorting_1"> <?php echo $orderlist['vendor_order_id']; ?></td>
                        <td class="sorting_1"><?php echo $orderlist['order_date']; ?></td>
						<td class="sorting_1"><?php echo $orderlist['assign_qty'].$orderlist['discount_price']; ?></td>
						<td class="sorting_1"><?php echo $orderlist['vendor_order_id']; ?></td>
						<td class="sorting_1"><?php echo $orderlist['name']; ?></td>
						<td class="sorting_1">
						<?php $pi=mysqli_fetch_array($db->query(" Select count(*) as t_pi from vendor_proforma where vendor_id='$orderlist[ventor_id]' AND vend_order_id='$orderlist[vendor_order_id]'" ));
						if($pi['t_pi']==0){
							echo "Awaiting For Pi";
						}else{
						 $sumqty=mysqli_fetch_array($db->query("SELECT SUM(assign_qty) as totalorder FROM `proposed_items` where ventor_id='$orderlist[ventor_id]' AND vendor_order_id='$orderlist[vendor_order_id]'"));
						 $proposedsumqty=mysqli_fetch_array($db->query("SELECT SUM(proforma_receive_qty) as totalorderq FROM `vendor_proforma_detail` where vendor_id='$orderlist[ventor_id]' AND vend_order_id='$orderlist[vendor_order_id]'"));
						 if($sumqty['totalorder']!= $proposedsumqty['totalorderq']){
							 echo "Awaiting Pi For Pending qty";
						 }else if($sumqty['totalorder']== $proposedsumqty['totalorderq']){
							 echo "Pi Received";
						 }

						}
						?>
						</td>
						<td class="sorting_1"><form method="post" action="">
						<input type="hidden" name="email" value="q">
						<input type="submit" class="btn btn-primary" value="Send Reminder" name="emailpi">
						</form></td>
						
						<td><a href="track_proforma.php?getid=<?php echo $orderlist['vendor_order_id']; ?>&vid=<?php echo $orderlist['ventor_id']; ?>"> <button class="btn btn-default btn-sm">Edit</button></a></td>
						<td><button class="btn btn-info btn-sm" data-toggle="modal" data-target=".orderedit<?php echo $orderlist[0]; ?>"> <i class="fa fa-pencil"></i></button></td>
						</tr> 

                                                <?php } ?>

		 						</tbody>
                                            </table>


                                    


                                    </div>
                                </section>
                            </div>

                             </div>



<?php include("footer.php"); ?>


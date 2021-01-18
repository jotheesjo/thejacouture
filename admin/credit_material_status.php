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
                                    <!-- responsive-data-table table-striped  -->
                                     <table width="100%"  class="table convert-data-table table-striped " >


<thead>
                                                <tr role="row">
												 <th>S.no</th>
												<th>Date</th>
												
                                                <th>Order No:</th>
                                                <th >User Name</th>
                                                <th>products</th>
                                                <th>Amount</th>
                                                <th>Status</th>

                                             

                                                </thead>


                                                <tbody> 
<?php $row=$db->query("SELECT * FROM vendor_proforma_payment_approve where payment_status='paid' AND type='credit'");
$ven_order=array();
while($ow=mysqli_fetch_array($row)){
	
	$ven_order[]=$ow['v_order_id'];
	
}
//$ven_order=array_unique($ven_order);  
//echo "SELECT ord_id FROM proposed_items where vendor_order_id IN ('". implode("', '", $ven_order)."')";
$result=array();
$r=$db->query("SELECT ord_id FROM proposed_items where vendor_order_id IN ('". implode("', '", $ven_order)."')");
while($ow1=mysqli_fetch_array($r)){
 $result[] = $ow1['ord_id'];
// print_r($result);
}
$result=array_unique($result);
print_r($result);
?>
<?php    $cartlist = $db->query("select * from orders where orders_id IN ('". implode("', '", $result)."')"); 
$olist=1;
 while ($orderlist = mysqli_fetch_array($cartlist)) {
     $orderid = $orderlist[2];
     $cusid = $orderlist[1];
	$tr = $orderlist['track'];
  $cusd = $db->queryUniqueObject("select * from users where id='$cusid' ");


?>
        

                                                <tr role="row" class="odd">
                                                    <td class="invert-closeb"> <?php  echo $olist++; ?> </td>

                                                    <td class="sorting_1"> <?php echo $orderlist['date']; ?></td>
                                                    


                                                   <!--  <td><button class="btn btn-primary btn-xs">View<i class="fa fa-eyes-open"></i></button></td> -->
                                                   
                                                   <td> <?php echo $orderid; ?>
                                 <br>
                                                   </td>
                                                    <td><?php  echo $orderlist['fname']; echo $orderlist['lname'];  ?> <br>Ph: <?php echo $orderlist['phone']; ?>  </td>
                                                     
                        <td align="left">
<?php 
 $proli = $db->query("select * from cart where orders_id='$orderid' and status='cartord' "); 
 $csumofvalue  ='';
 while ($ss = mysqli_fetch_array($proli)) {
     $prod = $db->queryUniqueObject("select * from products where id='$ss[pro_id]' ");

    $cqty = $ss['qty'];
    $cprice = $ss['price'];
    $sbtotal =  $cqty*$cprice; 
    $csumofvalue +=$sbtotal;
?>
<?php echo $prod->partid;  ?> = <?php  echo $ss[3];  ?> X <?php echo  $ss[4];  ?><br> 

<?php } ?> 
                        </td>
                        <td>INR <?php echo $csumofvalue; ?></td>
                         
					<td>	<a href="view_credit_material_status.php?getid=<?php echo $orderid; ?>"> <button class="btn btn-default btn-sm">View</button></a></td>							 

                                                </tr> 

                                                <?php } ?>

		 						</tbody>
                                            </table>


                                    


                                    </div>
                                </section>
                            </div>

                             </div>



<?php include("footer.php"); ?>


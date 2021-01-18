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



<div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-block">

                                            <h4 class="mt-0 header-title">Get Parts From Vendor  </h4>
<a href="view_orders.php"> <button class="btn btn-primary">Back</button></a>

<div class="panel">
  <div class="panel-heading">Order Details  <br>
<h3>ORDER ID : <?php echo $orderid;?>  </h3>
  </div> 
    <div class="panel-body">
      <div class="col-sm-4">

        <div class="panel panel-default">
                                                    <header class="panel-heading">
                                                        Billing Address
                                                    </header>
                                                    <div class="panel-body">
                                                        Spares Factory
                                                    </div>
                                                </div>

        
      </div>

      <div class="col-sm-4">

<div class="panel panel-default">
                                                    <header class="panel-heading">
                                                        Shipping Address
                                                    </header>
<div class="panel-body">
<small>[ <?php  echo $ofname; echo $olname; echo '<br>';  echo $oaddress; echo '<br>'; echo $ophone; echo ','; echo $oemail; echo '<br>'; echo $ocity; echo '-';echo $opin; ?>  ]
</small>

                                                    </div>
                                                </div>


      </div>

      <div class="col-sm-4">

</div>


<!--<form action="process.php" method="post">-->

    <input type="hidden" name="ordid" value="<?php echo $orderid;?>">


<?php 
 $proli = $db->query("select * from cart where orders_id='$orderid' and status='cartord' "); 
 $csumofvalue  ='';
 $con = 1; 
 $slno=1;
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
  <tr style="color: orange;" >  <td> <?php echo $slno++; ?>. </td><td><img src="<?=$prodtt->image; ?>" style="width: 50px;height: 50px;" /></td> <td><?php  echo $prodtt->partid;?></td> <td><?php  echo $prodtt->partid;?></td>     <td><?php echo $ss['qty'] ?></td> <td><?php echo $orprice=  $ss['price'] ?>/qty</td><td><?php echo $progst;  $prate =  ($orprice*$progst)/100;  ?>%</td><td><?php echo $tot=$prate+$orprice;   ?></td> <td><?=$expdate; ?></td>  </tr>

</table>



<table class="table" BORDERCOLOR="orange">
  <tr><th>Ven ID</th> <th>Ven Name</th><th>Ven.Location</th><th>Part ID</th><th>Basic Price</th><th>Disc %</th>
  <th>Dis. price</th><th>Rdy Stock</th><th>Gst</th><th>Total</th> <th>Profit</th><th>Assigned items</th><th>Assign</th> </tr>
<?php  
 $partv = $db->query("select * from vendor_parts where pro_id='$cpid' "); 
 while ($pv = mysqli_fetch_array($partv)) {
   $venid =  $pv['tr_id'];
   $ppid =  $pv['pro_id'];

   $amt =  $pv['amt'];
   $discount =  $pv['discount'];
   $discount =  $pv['discount'];
   $ven_qty =  $pv['qty']; 

    $vendtt = $db->queryUniqueObject("select * from vendor where id='$venid' ");
if($ppid == '') { echo '<b>No vendors available for this part ID</b><br>'; } else {
?>


<tr id="vendorlist">
  <td><?php echo $vendtt->vendorid; ?></td><td><?php echo $vendtt->name; ?></td><td><?php echo $vendtt->state; ?></td><td><?php  echo $prodtt->partid;?></td> <td><?php echo $amt; ?></td><td><?php echo $discount; ?></td><td> <?php $disamt = $amt-(($amt*$discount)/100);  echo  $disamt; ?></td><td><?=$ven_qty; ?></td><td><?php echo $progst.'%';  $vprate =  ($venprice*$progst)/100;  ?></td><td> <?=$grant=$disamt+(($disamt*$progst)/100); ?></td> <!--<td>0</td> <td>0</td><td>1 day</td> <td><?=$prodtt->gst; ?></td><td>nn</td><td>2%</td>--><td><?=$profit=$tot-$grant; ?>/qty</td>
  <td><?php $ass_qty=$db->queryUniqueObject("select assign_qty from proposed_items where spare_id='$prodtt->id' AND ventor_id='$venid' AND ord_id='$orderid'");
echo $ass_qty->assign_qty;  ?></td>
  <td>
  <form method="post" action="insert.php">
  <?php $tot_assign_qty=mysqli_fetch_array($db->query("select sum(assign_qty) as assigned from proposed_items where spare_id='$prodtt->id'  AND ord_id='$orderid'"));
 $maxassign= $ss['qty']-$tot_assign_qty['assigned']; ?>
  <input type="number" name="qty" max="<?=$maxassign; ?>" required="required">
  <input type="hidden" name="orderid" value="<?=$orderid; ?>">
  <input type="hidden" name="vendorid" value="<?=$venid; ?>">
  <input type="hidden" name="spareid" value="<?=$prodtt->id; ?>">
  <input type="hidden" name="sparename" value="<?=$prodtt->partid; ?>">
<input type="submit" class="btn btn-primary" name="sendproposal" value="Assign">
</form>
  </td>
</tr>
<?php } }  ?> 
</table>


<?php   }  ?> 





<style type="text/css">  
  #vendorlist{
  background: #f9882852;
}

</style>
<p align="right">    <button class="btn btn-primary" name="submitval" value="1">Get Proforma </button> </p>

<!--</form>-->



    </div>
</div>

							<?php include("footer.php") ?>
							
							
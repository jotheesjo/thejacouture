<?php include("header.php"); ?>
<?php include("nav_bar.php"); ?>
<?php include("nav_left.php"); ?>

<?=$oid=$_GET['ord_id']; ?>
<div class="row">
    	<div class="col-md-12">

             <table class="table table-bordered table-cart">
              <thead>
                <tr>
                  <th>Sno.</th>
                  <th>Part ID</th>
                  <th>Quantity</th>
                  <th>price</th>
                  <th>SubTotal</th>
                </tr>
              </thead>
              <tbody>
                

      

<?php   $cartlist = $db->query("select * from cart where orders_id='$oid'"); 
$csumofvalue  =''; $osn=1;$ij=0; $cqty1=''; $cprice=''; 
 while ($clist = mysqli_fetch_array($cartlist)) {
   $prod = $db->queryUniqueObject("select * from products where id='$clist[pro_id]' ");

  $cqty = $clist['qty'];
  $cqty1 +=$cqty ;
  $cprice = $clist['price'];
  $cprice1 +=$cprice;
  $sbtotal =  $cqty*$cprice; 
  $csumofvalue +=$sbtotal;
?>
          <tr class="rem1">
            <td>
            <?php  echo $osn++; $ij++; ?> 
           </td>
            <td class="invert"><?php echo $prod->partid;  ?></td>
            <td>  <label> <?php echo  $cqty; ?> </label> </td>
            <td class="invert">INR <?php echo $cprice; ?></td>
            <td class="invert">INR <?php echo $sbtotal;  ?></td>
          </tr>
<?php } ?>

<tr><td ></td>
  <td>Total Items : <?php echo $ij; ?></td>
  <td>Total Qty : <?php echo $cqty1; ?></td>
   <td>Total Amount</td> <td><b>INR <?php echo $csumofvalue; ?>.00</b></td></tr>
            
              </tbody>
            </table>


    	 
    	</div>
    </div>
	
<?php  include("footer.php")?>
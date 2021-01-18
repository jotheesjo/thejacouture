<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");
$ordinfo=$db->queryUniqueObject("SELECT * FROM orders WHERE id='$_GET[ordid]'"); 
$ship=json_decode($ordinfo->shipping_address);
$bill=json_decode($ordinfo->billing_address);
?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <?php if(isset($_GET['msg'])){
          echo '<h4>'.$_GET['msg'].'</h4>';
        }?>
        <div class="col-xs-12">
          <a href="invoice.php?id=<?=$_GET['ordid'];?>" class="btn btn-info btn-sm pull-right"><i class="lnr lnr-inbox"></i>  Invoice</a>
        </div>
        <div class="col-md-6">
          <!-- BASIC TABLE -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Order #<?=$ordinfo->order_id;?></h3>
            </div>
            <div class="panel-body">
             <table width="100%"  class="table convert-data-table table-striped">
              <thead>
                <tr><th>Order Date</th><th><?=date('M d Y h:i:s a',strtotime($ordinfo->date));?></th></tr>
                <tr><th>Order Status</th><th><?=$ordinfo->order_status;?></th></tr>
                <tr><th>Order Price</th><th>INR <?=$ordinfo->total_price;?></th></tr>
                <tr><th>Payment Method</th><th><?=$ordinfo->order_type;?></th></tr>
                <tr><th>Payment Status</th><th><?=$ordinfo->payment_status;?></th></tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <!-- BASIC TABLE -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Account Information</h3>
          </div>
          <div class="panel-body">
           <table width="100%"  class="table convert-data-table table-striped">
            <thead>
              <tr><th>Customer Name</th><th><?=$bill->billname;?></th></tr>
              <tr><th>Email</th><th><?=$bill->billemail;?></th></tr>
              <tr><th>Mobile</th><th><?=$bill->billmobile;?></th></tr>
              
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <!-- BASIC TABLE -->
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Billing Address</h3>
        </div>
        <div class="panel-body">
         <p><?php echo $bill->billname.'<br/>';
         echo $bill->billemail.'<br/>';
         echo $bill->billmobile.'<br/>';
         echo $bill->billaddr1.'<br/>';
         echo $bill->billcity.'<br/>';
         echo $bill->billstate.'<br/>';
         echo $bill->billcountry.' - '.$bill->billpincode;
         ?>
       </p>
     </div>
   </div>
 </div>
 <div class="col-md-6">
  <!-- BASIC TABLE -->
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">Shipping Address</h3>
    </div>
    <div class="panel-body">
      <p><?php echo $ship->sname.'<br/>';
      echo $ship->semail.'<br/>';
      echo $ship->smobile.'<br/>';
      echo $ship->saddr1.'<br/>';
      echo $ship->scity.'<br/>';
      echo $ship->sstate.'<br/>';
      echo $ship->scountry.' - '.$ship->spincode;
      ?>
    </p>
  </div>
</div>
</div>
</div>


<div class="row">
  <div class="col-md-12">
    <!-- BASIC TABLE -->
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Order List</h3>
      </div>
      <div class="panel-body">
        <table width="100%"  class="table convert-data-table table-striped">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>Product</th>
              <th>Qty</th>
              <th>Name </th>
              <th>Price</th>

            </tr>
          </thead>
          <tbody>
           <?php $orderdata=json_decode($ordinfo->order_detail,TRUE);
           $i=0;
           
           foreach($orderdata as $orderdata){ $i++;
            $prod_id=$orderdata['product_id'];
            $product=$db->queryUniqueObject("SELECT img_path FROM products WHERE product_id='$prod_id'");
            $img=json_decode($product->img_path);
            echo '<tr><td>'.$i.'</td><td><img alt="" style="width:30px" src="../'.$img[0].'"></td>
            <td class="quantity">'.$orderdata['qty'].'</td>
            <td>'.$orderdata['name'].'</td>';

            if(($orderdata['offer']!='') && ($orderdata['offer']!='0')){
              $dicsprice=($orderdata['price'])-(($orderdata['offer']/100)*$orderdata['price']);
              echo '<td class="total"><ins> INR<span id="prprice">'.$dicsprice.'</span></ins><br/><span id="prdiscount"><del> INR '.$orderdata['price'].'</del></span></td>';
            }else{
             echo '<td class="total"><ins> INR '.$orderdata['price'].'</ins></td>';
           }    echo '</tr>';
         }
         ?>
         <tr><td></td><td></td><td></td><td>Total</td><td><b>INR <?=$ordinfo->total_price;?></b></td></tr>
		   <tr><td></td><td></td><td></td><td>Shipping Cost</td><td><b>INR <?=$ordinfo->ship_cost;?></b></td></tr>
         <?php if($ordinfo->coupon_status='1'){
          echo "<tr><td>Coupon Applied: ".$ordinfo->coupon_code."</td><td></td><td></td><td>Grant Total</td><td class='total'><b> INR ".$ordinfo->grant_total."</b></td></tr>";
        }?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>



<div class="row">
  <div class="col-md-12">
    <!-- BASIC TABLE -->
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Order And Delivery Status</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-8">
          <form method="POST" action="update.php">
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="pending" <?php if($ordinfo->order_status=='pending'){ echo ' selected';} ?>>Pending</option>
                  <option value="pending" <?php if($ordinfo->order_status=='packing'){ echo ' selected';} ?>>Packing</option>
                <option value="shipped" <?php if($ordinfo->order_status=='shipped'){ echo ' selected';} ?>>Shipped</option>
                <option value="completed" <?php if($ordinfo->order_status=='completed'){ echo ' selected';} ?>>Completed</option>
                <option value="cancelled" <?php if($ordinfo->order_status=='cancelled'){ echo ' selected';} ?>>Cancel</option>
                <option value="cancelled by user" <?php if($ordinfo->order_status=='cancelled by user'){ echo ' selected';} ?>>cancelled by user</option>
              </select>
            </div>
            <div class="form-group">
              <label>Information</label>
              <textarea class="form-control" name="shipping_information"><?=$ordinfo->shipping_information;?></textarea>
              <input type="hidden" value="<?=$_GET['ordid'];?>" name="order_id">
              <input type="hidden" value="<?=$_GET['userid'];?>" name="user_id">
              <input type="hidden" name="ship_email" value="<?php echo $bill->billemail; ?>">
              <input type="hidden" name="ship_name" value="<?php echo $bill->billname; ?>">

            </div>
            <div class="form-group">
             <button type="submit" class="btn btn-sm btn-success" name="update_order_status">update</button>
           </div>
         </form> 
       </div>
       <div class="col-md-4">
        <!-- <h5>Order Information</h5> -->
        <p><?=$ordinfo->shipping_information;?></p>
      </div>

  </div>
</div>
</div>

</div>




</div>
</div>








<?php include("footer.php") ?>
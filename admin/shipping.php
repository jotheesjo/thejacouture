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
          <?php 
          $curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $delhivery_pincodeurl.$delhivery_api."&filter_codes=".$ship->spincode);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$delivery=json_decode($output,true); 
          if(!empty($delivery)){
          if($delivery[delivery_codes][0][postal_code][pre_paid]=='Y'){
              echo '<p style="color:#ff0000"><b>'.$ship->spincode.' Delivery option available to this pincode</b></p>';
          }else{
              echo '<p style="color:#ff0000"><b>'.$ship->spincode.' Prepaid delivery option not available at this time</b></p>';
          }              
          }else{
              echo '<p style="color:#ff0000"><b>'.$ship->spincode.' Delivery option not available at this time</b></p>';
          }

          ?>
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
        <h3 class="panel-title">Calculate Shipping Price</h3>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
              <form method="GET" action=""> 
           
                <div class="col-md-4">
                     <div class="form-group">
                <select class="form-control" name="md" required>
                <option disabled selected value="">Mode of Shipment</option>
                <option value="E">Express</option>
                <option value="S">Surface</option>
                </select>
                    </div>
                  </div>
                  
                 <div class="col-md-4">
                      <div class="form-group">
                <input type="text"  class="form-control" name="cgm" value="" placeholder="Weight in Gms" required>
                </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                <input type="text" class="form-control" name="o_pin" value="641001" placeholder="Origin PIN" required>
                </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                <input type="text" class="form-control" name="d_pin" value="<?=$ship->spincode;?>" placeholder="Destination PIN" required>
                </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                <select class="form-control" name="ss" required>
                <option value="" disabled selected>Status of Shipment</option>
                <option value="Delivered">Delivered</option>
                <option value="RTO">RTO</option>
                <option value="DTO">DTO</option>
                </select>
                </div>
                     <input type="hidden" name="ordid" value="<?=$_GET['ordid'];?>">
                <input type="hidden" name="userid" value="<?=$_GET['userid'];?>">
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
             <button type="submit" class="btn btn-sm btn-success" name="update_order_status">Calculate Price </button>
                </div>
                  </div>
          
         </form> 
            
            <?php
if(isset($_GET['md']) && isset($_GET['ss'])){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/api/kinko/v1/invoice/charges/?md=".$_GET['md']."&cgm=".$_GET['cgm']."&o_pin=".$_GET['o_pin']."&d_pin=".$_GET['d_pin']."&ss=".$_GET['ss'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token d21171173d06430805e5331ce1942757122c1148",
    "Content-Type: application/json",
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);
//echo '<pre>';
//echo $response;
//    echo '</pre>';
    $sprice=json_decode($response,true);
curl_close($curl);
    }
            ?>
<div class="col-md-12">
    <table class="table convert-data-table table-striped">
        <tr>
            <td> Forward Amount</td>
            <td>RS. <?=$sprice[0]['gross_amount'];?></td>
        </tr>
        <tr>
            <td>RTO Charge</td>
            <td>RS. <?=$sprice[0]['charge_RTO'];?></td>
        </tr>
        <tr>
            <td>COD Charge</td>
            <td>RS. <?=$sprice[0]['charge_COD'];?></td>
        </tr>
        <tr>
            <td>DTO Charge</td>
            <td>RS. <?=$sprice[0]['charge_DTO'];?></td>
        </tr>
        <tr>
            <td>CGST</td>
            <td>RS. <?=$sprice[0]['tax_data']['CGST'];?></td>
        </tr>
        <tr>
            <td>SGST</td>
            <td>RS. <?=$sprice[0]['tax_data']['SGST'];?></td>
        </tr>
        <tr>
            <td>Total Amount</td>
             <td><h4><strong>RS. <?=$sprice[0]['total_amount'];?></strong></h4></td>
        </tr>
    </table>
</div>
          </div>
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
        <div class="col-md-12">
                <?php
                if($ship->spincode!=''){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $delhivery_pincodeurl.$delhivery_api."&filter_codes=".$ship->spincode);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);
$delivery=json_decode($output,true); 
                    
                    
//waybill number
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $delhivery_waybillurl.$delivery_client."&token=".$delhivery_api."&count=1");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$waybilloutput = curl_exec($curl);
curl_close($curl);

      $waybillnumber=json_decode($waybilloutput,true);              
                   // print_r($waybill);                
?>
            <div class="col-md-6">
                <table class="table convert-data-table table-striped" width="100%">
                <thead><td>Title</td><td>Status</td></thead>
                <tr><td>Pincode</td><td><?=$delivery['delivery_codes'][0]['postal_code']['pin'];?></td></tr>
                <tr><td>Prepaid Delivery</td><td><?=$delivery['delivery_codes'][0]['postal_code']['pre_paid'];?></td></tr>
                <tr><td>Cash on Delivery</td><td><?=$delivery['delivery_codes'][0]['postal_code']['cod'];?></td></tr>
                <tr><td>Replacement</td><td><?=$delivery['delivery_codes'][0]['postal_code']['repl'];?></td></tr>
                <tr><td>District</td><td><?=$delivery['delivery_codes'][0]['postal_code']['district'];?></td></tr>
                <tr><td>State Code</td><td><?=$delivery['delivery_codes'][0]['postal_code']['state_code'];?></td></tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <table class="table convert-data-table table-striped" width="100%">
                <thead><td>Title</td><td>Warehouse Information</td></thead>
                <tr><td>Phone</td><td>8754943228</td></tr>
                <tr><td>E-hone</td><td>tejamulik@gmail.com</td></tr>
                <tr><td>city</td><td>Coimbatore</td></tr>
                <tr><td>pickup/warehouse</td><td>THEJA FRANCHISE</td></tr>
                <tr><td>Client Name</td><td>THEJA FRANCHISE</td></tr>
                <tr><td>Pincode</td><td>641001</td></tr>
                <tr><td>address</td><td>Big Bazzar Street, Townhall,Coimbatore</td></tr>
                <tr><td>country</td><td>India</td></tr>
                </table>
            </div>
                <?php
                } ?>
<?php //if($ordinfo->order_status=="pending"){ ?>
    <form method="GET" action="ship-order.php"> 
            <div class="form-group">
                <input type="hidden" name="ordid" value="<?=$_GET['ordid'];?>">
                <input type="hidden" name="userid" value="<?=$_GET['userid'];?>">
                <input type="hidden" name="create_ship" value="1">
             <button type="submit" class="btn btn-sm btn-success" name="update_order_status">Ship / view order </button>
           </div>
         </form> 
<?php //}?>
        
       </div>
      
  </div>
</div>
</div>

</div>
      

        
</div>
</div>








<?php include("footer.php") ?>
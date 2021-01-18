<?php include("header.php");
include("nav_bar.php");
include("nav_left.php");
$ordinfo=$db->queryUniqueObject("SELECT * FROM orders WHERE id='$_GET[ordid]'"); 
$ship=json_decode($ordinfo->shipping_address);
$bill=json_decode($ordinfo->billing_address);
$orderdata=json_decode($ordinfo->order_detail,TRUE);
$custom_shipaddress= addslashes($ship->sname.', '.$ship->saddr1.', '.$ship->saddr2.', '.$ship->saddr3.', '.$ship->scity.', '.$ship->sstate.', '.$ship->scountry.', Phone: '.$ship->smobile.', '.$ship->saltr_mobile);?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- BASIC TABLE -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Order #<?=$ordinfo->order_id;?>
                </h3>
            </div>
            <div class="panel-body">
             <?php if($_GET['create_ship']==1){
       // create order
$mjs="format=json&data={\r\n  \"pickup_location\": {\r\n    \"pin\": \"641001\",\r\n    \"add\": \"Big Bazzar Street, Townhall,Coimbatore\",\r\n    \"phone\": \"8754943228\",\r\n    \"state\": \"tamilnadu\",\r\n    \"city\": \"coimbatore\",\r\n    \"country\": \"india\",\r\n    \"name\": \"THEJA FRANCHISE\"\r\n  },\r\n  \"shipments\": [{\r\n    \"return_name\": \"THEJA FRANCHISE\",\r\n    \"return_pin\": \"641001\",\r\n    \"return_city\": \"coimbatore\",\r\n    \"return_phone\": \"8754943228\",\r\n    \"return_add\": \"Big Bazzar Street, Townhall,Coimbatore\",\r\n    \"return_state\": \"tamilnadu\",\r\n    \"return_country\": \"india\",\r\n    \"order\": \"$ordinfo->order_id\",\r\n    \"phone\": \"$ship->smobile\",\r\n    \"products_desc\": \"sarees\", \r\n    \"cod_amount\": \"0.0\",\r\n    \"name\": \"$ship->sname\",\r\n    \"country\": \"$ship->scountry\",\r\n    \"seller_inv_date\": \"\",\r\n    \"order_date\": \"$ordinfo->date\",\r\n    \"total_amount\": \"$ordinfo->grant_total\",\r\n    \"seller_add\": \"\",\r\n    \"seller_cst\": \"\",\r\n    \"add\": \"$custom_shipaddress, \",\r\n    \"seller_name\": \"theja couture\",\r\n    \"seller_inv\": \"\",\r\n    \"seller_tin\": \"\",\r\n    \"pin\": \"$ship->spincode\",\r\n    \"quantity\": \"1\",\r\n    \"payment_mode\": \"Prepaid\",\r\n    \"state\": \"tamilnadu\",\r\n    \"city\": \"$ship->scity\",\r\n    \"client\": \"THEJA FRANCHISE\"\r\n  }]\r\n}";
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $create_order,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$mjs,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token d21171173d06430805e5331ce1942757122c1148",
    "Content-Type: application/json"
  ),
));
$response = curl_exec($curl);

curl_close($curl);
$shipst=json_decode($response);
     $respons=mysqli_real_escape_string($db->connection,$response);
$newmble = substr($bill->billmobile, -10);
    if($shipst->packages[0]->status=='Fail'){  ?>
       <p>Your order already created. your waybil number is: <?=$shipst->packages[0]->waybill;?></p>
    <?php }else{     $db->query("UPDATE orders set courier_response='$respons',order_status='Shipped' WHERE id='$_GET[ordid]'");
                
                        //message success
$txtmsg="Your%20order%20from%20THEJA%20COUTURE%20has%20been%20Forwarded%20through%20delhivery%20courier%20service.%20Tracking%20ID:".$shipst->packages[0]->waybill.".%20Tracking%20link:%20https://delhivery.com";
//$txtmsg="Your%20order%20from%20Theja%20Couture%20is%20dispatched%20through%20delhivery%20Awb#".$shipst->packages[0]->waybill.".%20Track%20your%20on%20https://track.delhivery.com";
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sms.vstcbe.com/api/mt/SendSMS?user=Theja&password=Cour@123!&senderid=THEJAC&channel=Trans&DCS=0&flashsms=0&number=".$newmble."&text=".$txtmsg."&route=03&Dltsenderid=1701160465950023385",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response; 
                
                ?>
        <p>Your order created successfully. your waybil number is: <?=$shipst->packages[0]->waybill;?></p>
<?php      }
}
?>
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
<?php if($ordinfo->order_status=="Shipped"){ ?>
    <form method="GET" action="shipping-label.php">
            <div class="form-group">
                <input type="hidden" name="ordid" value="<?=$_GET['ordid'];?>">
                <input type="hidden" name="userid" value="<?=$_GET['userid'];?>">
                <input type="hidden" name="waybill" value="<?=$shipst->packages[0]->waybill;?>">
             <button type="submit" class="btn btn-sm btn-success" name="update_order_status">Download Shipping Label </button>
           </div>
         </form> 
<?php }?>
           
       </div>
      
  </div>
</div>
</div>

</div>
      
      
</div>
</div>

<?php include("footer.php") ?>
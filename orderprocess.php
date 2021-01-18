<?php session_start(); 
include('db.php');
require('razorpay-php/Razorpay.php');
// Create the Razorpay  Order
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
if(!isset($_SESSION['cart'])){
        header('Location:index.php');
    exit();
}
$_SESSION['ordref']=$_SERVER['REQUEST_TIME'];
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Confirm Order</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('head.php');?>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
     <?php include('header.php');?>

<style>
    .razorpay-payment-button{
        font-weight: 500;
color: #fff;
text-align: center;
user-select: none;
border: 1px solid transparent;
padding: .875rem 1.75rem;
font-size: 1rem;
line-height: 1.5rem;
-webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
 display: block;
width: 100%;
  background-color: #000000;
border-color: #000000;
border-radius: 50px;
  height: auto;
padding: 10px;      
    }
</style>
<?php

$billing=array(
    'billname'=>addslashes($_POST['name']),
    'billemail'=>addslashes($_POST['email']),
    'billmobile'=>addslashes($_POST['mobile']),
    'billaltr_mobile'=>addslashes($_POST['altr_mobile']),
    'billaddr1'=>addslashes($_POST['addr1']),
    'billaddr2'=>addslashes($_POST['addr2']),
    'billaddr3'=>addslashes($_POST['addr3']),
    'billcity'=>addslashes($_POST['city']),
    'billstate'=>addslashes($_POST['state']),
    'billcountry'=>addslashes($_POST['country']),
    'billpincode'=>addslashes($_POST['pincode'])
);

if(!isset($_POST['diffship'])){
    $shipping=array(
    'sname'=>addslashes($_POST['name']),
    'semail'=>addslashes($_POST['email']),
    'smobile'=>addslashes($_POST['mobile']),
    'saltr_mobile'=>addslashes($_POST['altr_mobile']),
    'saddr1'=>addslashes($_POST['addr1']),
    'saddr2'=>addslashes($_POST['addr2']),
    'saddr3'=>addslashes($_POST['addr3']),
    'scity'=>addslashes($_POST['city']),
    'sstate'=>addslashes($_POST['state']),
    'scountry'=>addslashes($_POST['country']),
    'spincode'=>addslashes($_POST['pincode'])
);
 }else{
$shipping=array(
    'sname'=>addslashes($_POST['sname']),
    'semail'=>addslashes($_POST['semail']),
    'smobile'=>addslashes($_POST['smobile']),
    'saltr_mobile'=>addslashes($_POST['saltr_mobile']),
    'saddr1'=>addslashes($_POST['saddr1']),
    'saddr2'=>addslashes($_POST['saddr2']),
    'saddr3'=>addslashes($_POST['saddr3']),
    'scity'=>addslashes($_POST['scity']),
    'sstate'=>addslashes($_POST['sstate']),
    'scountry'=>addslashes($_POST['scountry']),
    'spincode'=>addslashes($_POST['spincode'])
);

 }
$billing_address=json_encode($billing);
$shipping_address=json_encode($shipping);
        
        //************ Coupon Code ************//                     
                     if($_POST['coupon_percent']!=''){
                        $coupon_status="1";
						 $cprice=($_POST['coupon_percent']/100)* $_POST['tot_price'];
                     }else{
                        $coupon_status="0";
						$cprice=0;
                     }
//        end of coupon code
        
$without_offer_total=0;
$tot_price=0;
$prinfo=array();
     $i=0;   foreach ($_SESSION['cart'] as $key => $value) {
         $cart_qry=mysqli_query($conn,"SELECT product_id,name,sku,price,final_price,offer FROM products WHERE product_id='$key'");
            while($cart_row= mysqli_fetch_assoc($cart_qry)){
                $sub_tot1=$value*$cart_row['final_price'];
                if($cart_row['offer']!='0'){
                $sub_tot2=$value*$cart_row['price'];    
                }else{
                    $sub_tot2=$value*$cart_row['final_price'];
                } 
                //$sub_tot2=$value*$cart_row['mrp'];
                $tot_price=$tot_price+$sub_tot1;
                $without_offer_total=$without_offer_total+$sub_tot2;
                $prinfo[$i]=$cart_row;
                $prinfo[$i]['qty']=$value;
            $i++;
            }   
        }

$order_detail=json_encode($prinfo);
        

		//Shippin calc
		
		$md="E";
$cgm=$_POST['weight'];
$o_pin="641001";
$ss="Delivered";

if(isset($md) && isset($ss)){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/api/kinko/v1/invoice/charges/?md=E&cgm=".$cgm."&o_pin=".$o_pin."&d_pin=".$_POST['pincode']."&ss=".$ss,
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
//echo $curl;
$response = curl_exec($curl);

    $sprice=json_decode($response,true);
	//print_r($sprice); die;
	$ship_cost=$sprice[0]['total_amount'];
}
$totprice=$_POST['tot_price'];
$gt=($totprice-$cprice)+$ship_cost;
//        end of shipping calc


$count_ord=mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM `orders` ORDER BY id DESC LIMIT 0,1"));
$aa=50000+$count_ord['id']+1;
$ordid="THC".$aa;

$q=mysqli_query($conn, "INSERT INTO orders (user_id,order_id,order_detail,total_price,ship_cost,grant_total,shipping_address,billing_address,order_type,shipping_information,coupon_status,coupon_percent,coupon_code,date,notification,payment_status,order_status,ordref) VALUES ('$_SESSION[user_id]','$ordid','$order_detail','$_POST[tot_price]','$ship_cost','$gt','$shipping_address','$billing_address','razorpay','$_POST[shipping_information]','$coupon_status','$_POST[coupon_percent]','$_POST[coupon_code]',NOW(),'1','pending','pending','$_SESSION[ordref]')"); 

?>
<!-- CONTENT -->
    <section class="pt-7 pb-12">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">

            <!-- Heading -->
              <h3 class="mb-4">Confirm Order</h3>

          </div>
        </div>
        <div class="row">  
          <div class="col-12 col-md-7">
              <div class="row mb-9">
            <!-- Heading -->
                  <div class="col-12 col-md-7">
                  <h6 class="mb-7">Order Items (<?=$cart_count;?>)</h6>
                  </div>
            
            <!-- Divider -->
            <hr class="my-7">
            <!-- List group -->
            <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x mb-7">
                <?php
                $grand_total=0;
                foreach($_SESSION['cart'] as $prodid=>$qty){
                    $cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$prodid'");
                    while($cart_row=mysqli_fetch_array($cart_qry)){ ?>
                <li class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-4">
                    <!-- Image -->
                     <a href="product-details.php?<?=md5('prurl');?>=<?=$cart_row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($cart_row['product_id']);?>">
                         <?php $img_data=json_decode($cart_row['img_path']);?>
                      <img src="<?php echo $img_data[0];?>" class="img-fluid" >
                    </a>
                  </div>
                  <div class="col">
                    <!-- Title -->
                    <p class="mb-4 font-size-sm font-weight-bold">
                      <a class="text-body" style="text-transform:capitalize;" href="product-details.php?<?=md5('prurl');?>=<?=$cart_row['url'];?>&<?=md5('product_id');?>=<?=base64_encode($cart_row['product_id']);?>"><?=$cart_row['name'];?></a> <br>
                         <?php $sub_tot=$qty*$cart_row['price']; ?>
                       <span class="text-blue">Rs. <span class="ml-auto" id="amount_<?=$cart_row['product_id'];?>"><?php echo $sub_tot;?></span></span>
                        <?php $grand_total=$grand_total+$sub_tot;?>
                    </p>
                    <!-- Text -->
                    <div class="font-size-sm text-muted">
                      Quantity: <?=$qty;?> <br>
                    </div>
                  </div>
                </div>
              </li>
                    <?php }
                }?>
            </ul>
                  
              </div>

            
          </div>
          <div class="col-12 col-md-5 col-lg-4 offset-lg-1">


            <!-- Card -->
            <div class="card mb-9 bg-light">
              <div class="card-body">
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                  <li class="list-group-item d-flex">
                    <span>Subtotal</span> <span class="ml-auto font-size-sm">Rs. <span id="grandtotal"><?=round($tot_price);?></span></span>
                  </li>
                  <li class="list-group-item d-flex">
                    <span>Shipping Cost</span> <span class="ml-auto font-size-sm">Rs. <span id="shipprice"><?=$ship_cost;?></span></span>
                  </li>
                  <li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span>Total</span> <span class="ml-auto" >Rs. <span id="finaltotal"><?=$gt;?></span></span>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Button -->
              <?php
//payment gateway process
if($q){

$orderData = [
    'receipt'         => $ordid,
    'amount'          => $gt*100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
$displayCurrency='INR';
if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}
$checkout = 'automatic';   
if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $billing['billname'],
    "description"       => "order",
    "image"             => "https://www.thejacouture.in/images/logo.png",
    "prefill"           => [
    "name"              => $billing['billname'],
    "email"             => $billing['billname'],
    "contact"           => $billing['billmobile'],
    ],
    "notes"             => [
    "address"           => $billing['billcity'],
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
    "custom_order_id"   => $ordid,
];
if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}
$json = json_encode($data);
    require("razorpay-php/checkout/{$checkout}.php"); 
} ?>
          </div>
              
        </div>
      </div>
    </section>
<?php
include('footer.php');
?>
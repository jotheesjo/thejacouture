<?php session_start();
$_SESSION['ordref']=$_SERVER['REQUEST_TIME'];
echo '<style>
.razorpay-payment-button{
display:none;
}
</style>';
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Theja Couture</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <script src="js/vendor/jquery-1.11.1.min.js"></script>
<?php
require('razorpay-php/config.php');
require('razorpay-php/Razorpay.php');
include('db.php');
$receipt=rand(100000000,999999999);
// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         => $receipt,
    'amount'          => $_POST['grant_tot'] * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

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
    "name"              => $_POST['name'],
    "description"       => "",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => $_POST['name'],
    "email"             => $_POST['email'],
    "contact"           => $_POST['mobile'],
    ],
    "notes"             => [
    "address"           => $_POST['addr1'].','.$_POST['addr2'].','.$_POST['addr3'],
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);


 ?>
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
if(!isset($_POST['ship_to_different_address'])){
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

 if((isset($_POST['acc_create'])) && isset($_POST['pwd'])){
     $regname = $_POST['name'];
    $regemail = $_POST['email'];
    $regpwd = md5($_POST['pwd']);
    $exist=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customer WHERE email='$regemail'"));
if($exist<1){
     $from = "thejalcouture@gmail.com";  // this is the sender's Email address
  $to = $regemail; 
  $subject = "Greetings from Theja Couture";
  $message = "Thank you For register with thejacouture.in";
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);
   $inr="insert into customer(email, pwd,name)values('$regemail','$pwd','$name')";
   $result = mysqli_query($conn, $inr);
    $login=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM customer WHERE email='$regemail'"));
    $_SESSION['user_id']= $login['customer_id'];
        $_SESSION['user_type']='user';
        
}
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


$ship_cost=0;
$tot_price=0;
$prinfo=array();
     $i=0;   foreach ($_SESSION['cart'] as $key => $value) {
            $cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$key'");
            $prod_qry=mysqli_query($conn,"SELECT product_id,name,sku,price,final_price,offer FROM products WHERE product_id='$key'");
            while($cart_row= mysqli_fetch_assoc($cart_qry)){
                $sub_tot1=$value*$cart_row['final_price'];
                $tot_price=$tot_price+$sub_tot1;
            }   
        while($row=mysqli_fetch_assoc($prod_qry)){
            // $prinfo['prd_id']=$row['id'];
            // $prinfo['cart_qty']=$row['qty'];
            // $prinfo['cart_qty']=$row['qty'];
            $prinfo[$i]=$row;
            $prinfo[$i]['qty']=$value;
            $i++;
        }
        }
		
		
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
	//shiping calc end
$order_detail=json_encode($prinfo);

$count_ord=mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM `orders` ORDER BY id DESC LIMIT 0,1"));

                     $aa=50000+$count_ord['id']+1;
                     $ordid="UNA".$aa;

if($_POST['payment_mode']=='2'){
$ooid=$_SESSION['razorpay_order_id'];
//echo $_SESSION['ordref'];
$q=mysqli_query($conn, "INSERT INTO orders (user_id,order_id,order_detail,total_price,ship_cost,grant_total,shipping_address,billing_address,order_type,shipping_information,coupon_status,coupon_percent,coupon_code,date,notification,payment_status,txn_id,receipt,ordref) VALUES ('$_SESSION[user_id]','$ordid','$order_detail','$_POST[tot_price]','$ship_cost','$gt','$shipping_address','$billing_address','online payment','$_POST[shipping_information]','$coupon_status','$_POST[coupon_percent]','$_POST[coupon_code]',NOW(),'1','pending','$ooid','$receipt','$_SESSION[ordref]')");
if($q){

require("razorpay-php/checkout/{$checkout}.php");

}
}

?>
<script type="text/javascript">
$(function(){
    $('.razorpay-payment-button').trigger('click');
});
</script>

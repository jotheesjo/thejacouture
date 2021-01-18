<?php session_start();
include('db.php');
require('razorpay-php/config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);
    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );
        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)

    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}
if ($success === true)


$pay_response=json_encode($_POST,true);
	mysqli_query($conn, "UPDATE orders SET payment_status='success',txn_id='$_SESSION[razorpay_order_id]',order_status='Processing', payment_gateway_response='$pay_response' WHERE user_id='$_SESSION[user_id]' AND ordref='$_SESSION[ordref]'");
    //update qty
    $myorder_data=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM orders WHERE txn_id='$_SESSION[razorpay_order_id]'"));
    $shipping_address=$myorder_data['shipping_address'];
 $billing_address=$myorder_data['billing_address']; 
 $mop="2";
 $ship_cost=$myorder_data['ship_cost'];
 $sub_total=$myorder_data['total_price'];
 $grant_total=$myorder_data['grant_total'];
 $coupon_percent=$myorder_data['coupon_percent'];
 $ord_detail=$myorder_data['order_detail'];
 $morder=json_decode($myorder_data['order_detail'],true);
 $myorder_id=$myorder_data['order_id'];
 $mb=json_decode($billing_address,true);
 foreach($morder as $my_order){
    $product_data=mysqli_fetch_array(mysqli_query($conn,"SELECT qty FROM products WHERE product_id='$my_order[product_id]'"));
    $up_qty= $product_data['qty']-$my_order['qty'];
    mysqli_query($conn,"UPDATE products SET qty='$up_qty' WHERE product_id='$my_order[product_id]'");
 }
include('invoice_mail1.php');?>
<?php
//addFunction($shipping_address,$billing_address,$mop,$sub_total,$grant_total,$coupon_percent,$ord_detail,$ship_cost,$myorder_id,$conn);
    if(isset($myorder_data['order_id'])){
        $to="thejalcouture@gmail.com";
 //$to="suganya.clouddreams@gmail.com";
 $message="Dear Admin, New order received. Order id :".$myorder_data['order_id']." <br>";
 $subject="New order Received";
   $headers  = 'MIME-Version: 1.0' . "\r\n";
 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 $headers .= 'From: noreply@thejacouture.in';
 mail($to,$subject,$message,$headers);
 $billmobile=$mb['billmobile'];
        //message success
$txtmsg="Thank%20you%20for%20making%20your%20order%20in%20thejacouture!%20Your%20order%20".$myorder_data['order_id']."%20is%20confirmed%20and%20will%20be%20shipped%20shortly.%20For%20more%20details%20visit%20www.thejacouture.in";
        $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sms.vstcbe.com/api/mt/SendSMS?user=Theja&password=Cour@123!&senderid=THEJAC&channel=Trans&DCS=0&flashsms=0&number=".$mb['billmobile']."&text=".$txtmsg."&route=03&Dltsenderid=1701160465950023385",
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
//        exit();
	unset($_SESSION['coupon_status']);
	unset($_SESSION['coupon_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['razorpay_order_id']);
    unset($_SESSION['ordref']);
//$html = "<p>Your payment was successful</p>
      //       <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
//    echo '<pre>';
//    print_r($_SESSION);
//    echo '</pre>';
//        echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    exit();
	  header("location: success.php?ordid=".$myorder_data['order_id']);
	  exit();
}
else
{
	unset($_SESSION['cart']);
	unset($_SESSION['razorpay_order_id']);
    //$html = "<p>Your payment failed</p>
      //       <p>{$error}</p>";
	  header("location: failure.php");
	  exit();
}
//echo $html;
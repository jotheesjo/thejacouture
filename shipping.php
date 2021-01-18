<?php 
session_start();
$md="E";
$cgm=$_POST['weight'];
$o_pin="641001";
$ss="Delivered";
$gt=$_POST['gt'];


if(isset($md) && isset($ss)){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/api/kinko/v1/invoice/charges/?md=E&cgm=".$cgm."&o_pin=".$o_pin."&d_pin=".$_POST['d_pin']."&ss=".$ss,
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
//echo '<pre>';
//echo $response;
//    echo '</pre>';
    $sprice=json_decode($response,true);
	if($_SESSION['coupon_status']==1)
	{
		$grand_tot=$sprice[0]['total_amount']+$_SESSION['coupon_price'];
	}
	else
	{
	$grand_tot=$sprice[0]['total_amount']+$gt;
	}
	echo json_encode(array('ship_cost'=>round($sprice[0]['total_amount'], 2) ,'grand_price'=>round($grand_tot, 2)));
curl_close($curl);

//print_r($sprice[0]['total_amount']);
    }
?>
<?php
$pickup_time=$_GET['pickup_time'];
    $pickup_date=$_GET['pickup_date'];
    $pickup_location=$_GET['pickup_location'];
    $expected_package_count=$_GET['package_count'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://track.delhivery.com/fm/request/new/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\"pickup_time\":\"$pickup_time\",\"pickup_date\":\"$pickup_date\",\"pickup_location\":\"THEJAFRANCHISE-B2C\",\"expected_package_count\":\"$expected_package_count\"}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token d21171173d06430805e5331ce1942757122c1148",
    "Content-Type: application/json"
  ),
));
echo "{\"pickup_time\":\"$pickup_time\",\"pickup_date\":\"$pickup_date\",\"pickup_location\":\"THEJAFRANCHISE-B2C\",\"expected_package_count\":\"$expected_package_count\"}";
$response = curl_exec($curl);

curl_close($curl);
echo $response;
$resp=json_decode($response);
echo '<pre>';
print_r($resp);
if(isset($resp->pr_exist)){
    echo $resp->data->message;
}else{
    echo "your pickup request is initiated on ".$resp->pickup_date." ".$resp->pickup_time.". Your pickup id is:".$resp->pickup_id.". Total package count is: ".$resp->expected_package_count;
}
echo '</pre>';
?>
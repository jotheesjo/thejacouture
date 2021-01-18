<?php
$host = "localhost";
$username = "thejacou_theja";
$pwd = "sdfdsl^&d#$#d3D";
$dbname = "thejacou_theja";
//$username = "root";
//$pwd = "";
//$dbname = "theja";

$conn = mysqli_connect($host, $username, $pwd, $dbname); 
if($conn){
//echo "Data base connect successfully";
}
else{
    echo "Database Not connect".mysqli_error();
}
define('MAINURL','http://localhost/theja/');
//$keyId="rzp_test_Qsj2Fv5OmABIVo";
//$keySecret="llkmzdSjH5y59JcAI7B00gyn";
$keyId = 'rzp_live_5xMpBX4KRbf3cL';
$keySecret = 'zwcNAAybJjdKJSq54xYoTnW9';
$displayCurrency = 'INR';
?>
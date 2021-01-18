<?php

$host = "127.0.0.1";
//$username = "root";
//$pwd = "";
//$dbname = "theja";
$username = "thejacout_theja";
$pwd = "p@tXb3eSA";
$dbname = "thejacout_theja";

$conn = mysqli_connect($host, $username, $pwd, $dbname); 

if($conn){
//echo "Data base connect successfully";
}
else{
    echo "Database Not connect".mysqli_error();
}
?>
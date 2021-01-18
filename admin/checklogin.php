<?php
session_start();
include("lib/db.class.php");
include_once "config.php";
$db = new DB($config['database'], $config['host'], $config['username'], $config['password']);
$tablen = $_POST['position'];

$tbl_name = $tablen;

$myusername = $_REQUEST['username'];
$mypassword = $_REQUEST['password'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);

$myusername = mysqli_real_escape_string($db->connection, $myusername);
$mypassword = md5(mysqli_real_escape_string($db->connection, $mypassword));

$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword' and  status='1' ";
$result = mysqli_query($db->connection, $sql);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $row = mysqli_fetch_row($result);
    $_SESSION['admin_id'] = $row[0];
	$_SESSION['name'] = $row[1];
    $_SESSION['username'] = $row[2];
    $_SESSION['rights'] = $row[4];

header("location:welcome.php");	

} else {
           echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='index.php?msg=Invalid login';
    </SCRIPT>");

}
?>
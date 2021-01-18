<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['rights'] != 'admin')  
if (!isset($_SESSION['username']) || $_SESSION['rights'] != 'user')
if (!isset($_SESSION['username']) || $_SESSION['rights'] != 'vendor')	
		

{ // if session variable "username" does not exist.
    header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!&type=error"); // Re-direct to index.php
}
error_reporting(0);
include("lib/db.class.php");
if (!include_once "config.php") {
    header("location: install.php");
}

// Open the base (construct the object):
$db = new DB($config['database'], $config['host'], $config['username'], $config['password']);

# Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

require "lib/gump.class.php";

$gump = new GUMP();

 
?>

<?php if(isset($_SESSION['id'])) {

  $sessid = $_SESSION['id'];
   $sessname = $_SESSION['name'];
   $sessuname  = $_SESSION['username'];
   $sessrights =$_SESSION['rights'];
   $sessonline = 1;   
    }else 
    {
        $sessonline = 0; 
    } ?> 

<?php  $admind = $db->queryUniqueObject("select * from admin_details where   status='active' "); ?> 

  

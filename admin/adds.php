<?php 
include 'init.php';

if(isset($_GET['add_uom']))
{

$uname=$_GET['uomname'];
$uunit=$_GET['uomunit'];

$select=$db->query("SELECT * from uom  where name='$uname'");
$count=mysqli_num_rows($select);
if($count=="0")
{
	$ins=$db->query("INSERT INTO uom(name,remark) values('$uname','$uunit')");
	if($ins)
	{ 
	echo "1";
	}
	else
	{
	echo "0";
	}
}
else
{
echo "0";
}
}

if(isset($_GET['add_make']))
{
$makename=$_GET['makename'];

$select=$db->query("SELECT * from make  where name='$makename'");
$count=mysqli_num_rows($select);
if($count=="0")
{
	$ins=$db->query("INSERT INTO make(name) values('$makename')");
	if($ins)
	{ 
	echo "1";
	}
	else
	{
	echo "0";
	}
}
else
{
echo "0";
}
}







?>
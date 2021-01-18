
<?php

include 'init.php';

if(isset($_POST['get_option']))
{


 $catid = $_POST['get_option'];
 $find=$db->query("select * from sub_category  where cat_id='$catid'");
 while($row=mysqli_fetch_array($find))

 {
  echo "<option value=".$row[0].">".$row[2]."</option>";
 }
 exit;
}


if(isset($_POST['get_part']))
{

 $scatid = $_POST['get_part'];
 $find=$db->query("select * from sub_category  where id='$scatid'");
 while($row=mysqli_fetch_array($find))
 {
$catname =  $db->queryUniqueObject("select * from category where id='$row[1]' ");
$cn = $catname->cat_name;
$cid = $catname->id;
$cpath = $catname->path;
  echo $cpath.$cid.$row[0];
 }
 exit;
}

?>
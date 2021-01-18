<?php 
include('init.php');
$id=$_GET['id'];


if($id==1)
{
$query1=$db->query("SELECT * FROM uom ORDER BY id DESC");
while ($rows=mysqli_fetch_array($query1)){
$id=$rows['id'];
$unit_name=$rows['name'];	

$arr[]=array(
'value'=>$unit_name,
'id'=>$id
);

}

}

else if($id==2)
{

$query=$db->query("SELECT * FROM make ORDER BY id DESC");
while ($rows=mysqli_fetch_array($query)){
$id=$rows['id'];
$unit_name=$rows['name'];	

$arr[]=array(
'value'=>$unit_name,
'id'=>$id
);

}

}

echo json_encode($arr);


?>

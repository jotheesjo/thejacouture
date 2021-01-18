<style type="text/css">
  table,tr,td
  {
    border: 1px solid grey;
    text-align: center;
  }
  th
  {
    text-align: center;
    background-color: lightgrey;
  }
  table
  {
    width: 100%;
    text-align: center;
  }
</style>

<?php
include('init.php');

if(isset($_POST['submitval']))
{

$orderid=$_POST['ordid'];
$proid=$_POST['proid'];
$vendorid=$_POST['vendorid'];

$dd = '';

foreach ($_POST['vendorid'] as $key=>$value) {

$dd = 1; 

    
    $vid = $_POST['vendorid'][$key];
    $pid = $_POST['proid'][$key];

    $vendtt = $db->queryUniqueObject("SELECT * from vendor where id='$vid' ");
    $vendname = $vendtt->name;
    $venemail= $vendtt->email;

    $prodtat = $db->queryUniqueObject("SELECT * FROM products WHERE id='$pid'");
    $part = $prodtat->partid;
    $model = $prodtat->model;


if($vid !=''){
    // echo "string";
    $getp = $db->query("SELECT * from vendor_parts where tr_id='$vid'  ");
$count =0;
    while($getpro = mysqli_fetch_array($getp))
    {
$amt = $getpro['amt'];
$dis = $getpro['discount'];
$ven_part = $getpro['pro_id'];
// echo $orderid;
$getord = $db->query("SELECT * from cart where orders_id='$orderid'");

// echo $getord;
while($key= mysqli_fetch_array($getord)) {

   $prosid = $key['pro_id'];
   $quantity = $key['qty'];

$partid = $db->queryUniqueObject("SELECT * FROM products where id=$prosid");
$parid == $partid->id;
 $partins= $partid->partid;echo "<br>";
 $ven_part;
// if($partins == $ven_part)
// {
$spare_id[$count] = $partid->partid;
$amt[$count] = $amt;
$discount[$count] = $dis;
$quantity[$count] = $quantity;

$count++;

$sql = $db->query("INSERT INTO proposed_items (`ord_id`, `spare_id`, `ventor_id`, `pro_price`, `status`,`discount`) VALUES($orderid,'$partins','$vid','$amt','process','$dis')");

$dd =1;
// }
}

}







 // $to = "infop@sparesfactory.com";
       $to = $venemail;   
$ref=$_SERVER['HTTP_REFERER'];

$ref=$_SERVER['HTTP_REFERER'];
$subject="Proposal Form - From SPARES FACTORY ";

    
 $message='<table width=100%>
<thead>
<th>S.no</th>
<th>Part ID</th>
<th>Price</th>
<th>Quatity</th>
<th>Discount</th>
</thead>';
for($i=0;$i<=$count;$i++) {
 $message.='<tr><td>'.$i.'</td><td>'.$spare_id[$i].'</td><td>'.$amt[$i].'</td><td>'.$quantity[$i].'</td><td>'.$discount[$i].'</td></tr>';
}'
</table>'; 
$message.='Dear, $vendname';
$message.='This is the Product proposal from your Admin of SF. if have interest in this proposal just contact  me...</br><p align="center">Thank You.....';
     
// echo $message;
//   echo $venemail;
   
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: SF';


$retval = mail($to,$subject,$message,$headers);
}

}

if($dd == 1)
    {
        echo ("<SCRIPT language='javascript'>
        window.alert('Your Proposal Has Been Send to your vendor')
        window.location.href='proposals.php';</SCRIPT>");
        
        
    }
    else
    {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Adding .. ')
    window.location.href='proposals.php';
    </SCRIPT>");
    }



}



// else if(isset($_POST['submitval123']))
// {

// $orderid=$_POST['ordid'];


// $proli = $db->query("select * from cart where orders_id='$orderid' and status='cartord' "); 

//  while ($ss = mysqli_fetch_array($proli)) {

//    $getp = $db->query("select * from vendor_parts where tr_id='$vid'  ");

//     while($getpro = mysqli_fetch_array($getp))
//     {
// $amt = $getpro->amt;
// $dis = $getpro->discount;
// $part = $getpro->pro_id;

// $getord = $db->query("select * from cart where orders_id=$orderid ");

// foreach ($getord as $key => $value) {

//   $prosid = $value->pro_id;

//   if($part == $prosid)
//     {
// $partid = $db->queryUniqueObject("select * from products where pro_id = $prosid");

// $partins= $partid->partid;

// $spare_id[] = $partid->partid;
// $amt[] = $amt;
// $discount[] = $dis;

// }


// }

// }
//  $to = "infop@sparesfactory.com";
          
// $ref=$_SERVER['HTTP_REFERER'];

// $ref=$_SERVER['HTTP_REFERER'];
// $subject="Proposal Form - From SPARES FACTORY ";

    
// $message='<table width=100% border=0 border-color:none cellspacing=3 cellpadding=3 class=text style="font-family:Arial; line-height:160% word-spacing:0.4em font-size:14px; border: 1px solid" bgcolor="#F9F9F9" color:"#465864">
// <tr >
// <td colspan="4"  align="center" bgcolor="#e0e1e1" ><strong >Proposal Form   : SF ADMIN</strong></td>
// </tr>

// <tr> <td>Product Name</td> <td>:</td> <td >'.$part.'</td> </tr>
// <tr> <td>Model</td> <td>:</td> <td>'.$model.'</td> </tr>
// <tr> <td>Propossed Price</td> <td>:</td><td>'.$price.'</td> </tr>
// <tr> <td>Message</td> <td>:</td> <td>This is the Product proposal from your admin of SF. if have interest in this proposal jst contact  me...</br><p align="center">Thank You</td> </tr>
  
// </table>'; 
   
// //echo $message;
  
   
// // Set content-type header for sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // Additional headers
// $headers .= 'From: SF';


// $retval = mail ($to,$subject,$message,$headers);



//     $sql = $db->query("INSERT INTO proposed_items (`ord_id`, `spare_id`, `ventor_id`, `pro_price`, `status`) VALUES($orderid,'$part','$venid',$price,'process')");
//     if($sql)
//     {
//         echo ("<SCRIPT language='javscript'>
//         window.alert('Your Proposal Has Been Send to your vendor');
//         window.href='index.php';</SCRIPT>");
//     }
//     else
//     {

//         echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Error While Adding .. ')
//     window.location.href='proposals.php';
//     </SCRIPT>");
//     }


// }
// }
// }

elseif(isset($_POST['updateproposal']))
{
	$ord = $_POST['orderid'];
	$id = $_POST['prosid'];
	$status = $_POST['status'];
	$sql = $db->query("update proposed_items set status='$status' where id = $id");
	if($sql)
	{
		if($status == 'completed')
		{
$sql = $db->query("update orders set process_status='$status' where orders_id ='$ord'");
		}
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('successfully updated...')
    window.location.href='proposals.php';
    </SCRIPT>");
}
else
{

        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While process .. ')
    window.location.href='proposals.php';
    </SCRIPT>");
}
}

?>
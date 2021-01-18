<?php include('init.php'); ?>
<?php if(isset($_POST["export"])){
	ob_start();

	$output = '';
$result = $db->query("SELECT * FROM `orders` WHERE date BETWEEN '$_POST[from]' AND '$_POST[to]'");
if(mysqli_num_rows($result) > 0)
 {
$output .= '
   <table class="table" border="1">  
                    <tr>  
                         <th>Order ID</th>  
                         <th>Order Date</th>
                         <th>Product</th>  
                         <th>Selling Price</th>
                         <th>Gst</th>
                         <th>Total</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $price=$row["overall_total"]-((12/100)*$row["overall_total"]);
    $c=rtrim($row["cart_id"],',');
    $storeArray=explode(',',$c);
    $cc=array();
    foreach ($storeArray as $value) {
      $cc[]="'".$value."'";
    }
    
    $sql =$db->query("SELECT * FROM cart WHERE id In (" . implode(',', $cc) . ")");
    $overall='';
    while($rr=mysqli_fetch_array($sql)){
      $pname=mysqli_fetch_array($db->query("SELECT name,gst from products WHERE id='$rr[2]'"));
      $sellin=$rr[4]-($rr[4]*($pname['gst']/100));
      $output .= '
    <tr>  
                         <td>'.$row["orders_id"].'</td>  
                         <td>'.$row["date"].'</td>  
                         <td>'.$pname['name'].'</td>  
                         <td>'.$sellin.'</td>  
       <td>'.$pname['gst'].'</td>  
       <td>'.$rr[4].'</td>
                    </tr>';
                  $overall+=$rr[4];
    }
  }
  $output .= '<tr><td></td><td></td>
  <td colspan="3">Total</td>
  <td>'.$overall.'</td>
  </tr></table>';
  ob_get_clean();
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename='.$_POST[from].'-'.$_POST[to].'.xls');
  echo $output;
 }
}else if(isset($_POST["service_order"])){
  ob_start();

  $output = '';
$result = $db->query("SELECT * FROM `service_order` WHERE order_time BETWEEN '$_POST[from]' AND '$_POST[to]'");
if(mysqli_num_rows($result) > 0)
 {
$output .= '
   <table class="table" border="1">  
                    <tr>  
                         <th>Order ID</th>  
                         <th>Order Date</th>  
                         <th>Selling Price</th>
                         <th>Gst</th>
                         <th>Total</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $price=$row["overall_total"]-((12/100)*$row["overall_total"]);
   $output .= '
    <tr>  
                         <td>'.$row["id"].'</td>  
                         <td>'.$row["order_time"].'</td>  
                         <td>'.$price.'</td>  
       <td>'.'12%'.'</td>  
       <td>'.$row["overall_total"].'</td>
                    </tr>';
  }
  $output .= '</table>';
  ob_get_clean();
 header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
		?>
<?php session_start();
include('db.php');
//print_R($_POST);


//shipping address
if(isset($_POST['ship_to_different_address'])){
	$shipname=$_POST['sname'];
	$shipemail=$_POST['semail'];
	$shipmobile=$_POST['smobile'];
	$shipaltr_mobile=$_POST['saltr_mobile'];
	$shipaddr1=$_POST['saddr1'];
	$shipaddr2=$_POST['saddr2'];
	$shipaddr3=$_POST['saddr3'];
	$shipcity=$_POST['scity'];
	$shipstate=$_POST['sstate'];
	$shipcountry=$_POST['scountry'];
	$shippincode=$_POST['spincode'];
}else{
	$shipname=$_POST['name'];
	$shipemail=$_POST['email'];
	$shipmobile=$_POST['mobile'];
	$shipaltr_mobile=$_POST['altr_mobile'];
	$shipaddr1=$_POST['addr1'];
	$shipaddr2=$_POST['addr2'];
	$shipaddr3=$_POST['addr3'];
	$shipcity=$_POST['city'];
	$shipstate=$_POST['state'];
	$shipcountry=$_POST['country'];
	$shippincode=$_POST['pincode'];

}

//billing address
$billname=$_POST['name'];
$billemail=$_POST['email'];
$billmobile=$_POST['mobile'];
$billaltr_mobile=$_POST['altr_mobile'];
$billaddr1=$_POST['addr1'];
$billaddr2=$_POST['addr2'];
$billaddr3=$_POST['addr3'];
$billcity=$_POST['city'];
$billstate=$_POST['state'];
$billcountry=$_POST['country'];
$billpincode=$_POST['pincode'];

if(isset($_POST['createaccount'])){
	$pwd=md5($_POST['pwd']);

	mysqli_query($conn,"INSERT INTO `customer`( `name`, `email`, `pwd`, `status`) VALUES ('$billname','$billemail','$pwd','1')");
	$lastid=mysqli_insert_id($conn);
	$user_id=$lastid;
	if(isset($_POST['ship_to_different_address'])){
		mysqli_query($conn,"INSERT INTO `customer_address`( `customer_id`, `name`, `phone`, `alter_phone`, `email`, `addr1`, `addr2`, `addr3`, `city`, `state`, `country`, `zip`, `status`) VALUES ('$lastid','$billname','$billmobile','$billaltr_mobile','$billemail','$billaddr1','$billaddr2','$billaddr3','$billcity','$billstate','$billcountry','$billpincode','1')");
		mysqli_query($conn,"INSERT INTO `customer_address`( `customer_id`, `name`, `phone`, `alter_phone`, `email`, `addr1`, `addr2`, `addr3`, `city`, `state`, `country`, `zip`, `status`) VALUES ('$lastid','$shipname','$shipmobile','$shipaltr_mobile','$shipemail','$shipaddr1','$shipaddr2','$shipaddr3','$shipcity','$shipstate','$shipcountry','$shippincode','1')");
	}else{
		mysqli_query($conn,"INSERT INTO `customer_address`( `customer_id`, `name`, `phone`, `alter_phone`, `email`, `addr1`, `addr2`, `addr3`, `city`, `state`, `country`, `zip`, `status`) VALUES ('$lastid','$billname','$billmobile','$billaltr_mobile','$billemail','$billaddr1','$billaddr2','$billaddr3','$billcity','$billstate','$billcountry','$billpincode','1')");
	}

}else{
	$user_id=$_SESSION['user_id'];
}
$billing=array('billname'=>$_POST['name'],'billemail'=>$_POST['email'],'billmobile'=>$_POST['mobile'],'billaltr_mobile'=>$_POST['altr_mobile'],'billaddr1'=>$_POST['addr1'],'billaddr2'=>$_POST['addr2'],'billaddr3'=>$_POST['addr3'],'billcity'=>$billcity,'billstate'=>$billstate,'billcountry'=>$billcountry,'billpincode'=>$billpincode);

$shipping=array('shipname'=>$shipname,'shipemail'=>$shipemail,'shipmobile'=>$shipmobile,'shipaltr_mobile'=>$shipaltr_mobile,'shipaddr1'=>$shipaddr1,'shipaddr2'=>$shipaddr2,'shipaddr3'=>$shipaddr3,'shipcity'=>$shipcity,'shipstate'=>$billstate,'shipcountry'=>$billcountry,'shippincode'=>$shippincode);



$billing_address=json_encode($billing);
$shipping_address=json_encode($shipping);

   //**************** SUb total *****************/
$tot_price='';
$prinfo=array();
$i=0;   foreach ($_SESSION['cart'] as $key => $value) {
	$cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$key'");
	$prod_qry=mysqli_query($conn,"SELECT product_id,name,sku,price,final_price,img_path,offer FROM products WHERE product_id='$key'");
	while($cart_row= mysqli_fetch_assoc($cart_qry)){
		$sub_tot1=$value*$cart_row['final_price'];
		$tot_price=0;
		$tot_price=$tot_price+$sub_tot1;
	}


	while($row=mysqli_fetch_assoc($prod_qry)){
            // $prinfo['prd_id']=$row['id'];
            // $prinfo['cart_qty']=$row['qty'];
            // $prinfo['cart_qty']=$row['qty'];
		$prinfo[$i]=$row;
		$prinfo[$i]['qty']=$value;
		$i++;
	}

}
$order_detail=json_encode($prinfo);
if($_POST['coupon_percent']!=''){
	$coupon_code=$_POST['coupon_code'];
	$coupon_percent=$_POST['coupon_percent'];
	$coupon_status="1";
	$grant_total=$_POST['grant_tot'];
}else{
	$coupon_code='';
	$coupon_percent='';
	$coupon_status="0";
	$grant_total=$tot_price;
}
$count_ord=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders"));
$aa=50000+$count_ord;
$ordid="TRB".$aa;

if($_POST['payment_mode']=='1'){

	$q=mysqli_query($conn,"INSERT INTO orders (user_id,order_id,order_detail,total_price,grant_total,shipping_address,txn_id,order_type,payment_status,order_status,date,notification,coupon_code,coupon_percent,coupon_status,billing_address) VALUES ('$user_id','$ordid','$order_detail','$tot_price','$grant_total','$shipping_address','','$_POST[payment_mode]','success','pending',NOW(),'1','$coupon_code','$coupon_percent','$coupon_status','$billing_address')");

	if($q){
		echo json_encode(array('status'=>"success",'ord_id'=>$ordid));
	}
}else{
	$q=mysqli_query($conn,"INSERT INTO orders (user_id,order_id,order_detail,total_price,grant_total,shipping_address,txn_id,order_type,payment_status,order_status,date,notification,coupon_code,coupon_percent,coupon_status,billing_address) VALUES ('$user_id','$ordid','$order_detail','$tot_price','$grant_total','$shipping_address','','$_POST[payment_mode]','success','pending',NOW(),'1','$coupon_code','$coupon_percent','$coupon_status','$billing_address')");
	$datas=base64_encode(json_encode(array('status'=>'success1','ord_id'=>$ordid,'amount'=>$tot_price,'productinfo'=>'1','firstname'=>$shipname,'Zipcode'=>$shippincode,'email'=>$shipemail,'phone'=>$shipmobile,'city'=>$shipcity,'state'=>$shipstate,'country'=>$shipcountry,'address1'=>$shipaddr1)));
	echo json_encode(array('data'=>$datas));

}


?>
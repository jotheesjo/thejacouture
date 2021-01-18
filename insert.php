<?php session_start();
include('db.php');
// add address
if(isset($_POST['add_address'])){	
$insq=mysqli_query($conn, "INSERT INTO customer_address(customer_id,name,phone,alter_phone,email,addr1,addr2,addr3,city,state,country,zip,status) VALUES ('$_SESSION[user_id]','$_POST[name]','$_POST[mobile]','$_POST[altr_mobile]','$_POST[email]','$_POST[addr1]','$_POST[addr2]','$_POST[addr3]','$_POST[city]','$_POST[state]','$_POST[country]','$_POST[pincode]','1')");
if($insq){
	header("Location: address-book.php?msg=address added successfully");
	exit();
}else{
	header("Location: address-book.php?msg=something went wrong to create address");
	exit();
}
}
//update address
else if(isset($_POST['update_address'])){
	$updq=mysqli_query($conn, "UPDATE customer_address SET name='$_POST[name]',phone='$_POST[mobile]',alter_phone='$_POST[altr_mobile]',email='$_POST[email]',addr1='$_POST[addr1]',addr2='$_POST[addr2]',addr3='$_POST[addr3]',city='$_POST[city]',state='$_POST[state]',country='$_POST[country]',zip='$_POST[pincode]' WHERE address_id='$_POST[address_id]' AND customer_id='$_SESSION[user_id]'");
	if($updq){
		header("Location: address-book.php?msg=address updated successfully");
	exit();
}else{
	header("Location: address-book.php?msg=something went wrong to update address");
	exit();
}

}

?>
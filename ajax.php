<?php session_start();
include('db.php');
//sign up process
if((isset($_POST['sign_email'])) && (isset($_POST['sign_password']))){
    $name = $_POST['sign_name'];
    $email = $_POST['sign_email'];
    $pwd = md5($_POST['sign_password']);
    
    $exist=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customer WHERE email='$email'"));
if($exist<1){
	
     $inr="insert into customer(email, pwd,name)values('$email','$pwd','$name')";
    $result = mysqli_query($conn, $inr);
    if ($result) {
        $login = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE email='$email'"));
        $_SESSION['user_name']= $login['name'];
        $_SESSION['user_email']= $login['email'];
        $_SESSION['user_id']= $login['customer_id'];
        echo '<script type="text/javascript">
           window.location = "account-information.php"
      </script>';
    }
    else {
        $msg = "Something went wrong try again later";
        echo $msg;
    }

}else{
    $msg = "Account already exist. Kindly login or reset password";
        echo $msg;
}
}
//end of signup
// login process
else if((isset($_POST['email_login'])) && (isset($_POST['pwd_login']))){
    $email = $_POST['email_login'];
    $con_pwd = md5($_POST['pwd_login']);
    $sql = "SELECT * FROM customer WHERE email='$email' and pwd='$con_pwd'";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);
    if($count==1){

       $check=mysqli_fetch_array($result);
       if($check['status']==0){
          $msg = "Your account was disabled contact administrator";
        echo $msg;
    }else{
      $_SESSION['user_name']= $check['name'];
        $_SESSION['user_email']= $check['email'];
        $_SESSION['user_id']= $check['customer_id'];
        $_SESSION['user_type']='user';

        echo '<script type="text/javascript">
           window.location = "account-information.php"
      </script>';
    }

    }else {
        $msg = "Your username or password is incorrect";
        echo $msg;
    }

}
//end of login
//change password
else if((isset($_POST['ch_pwd'])) && (isset($_POST['cpwd']))){
    if($_POST['ch_pwd'] == $_POST['cpwd']){
      $password=md5($_POST['ch_pwd']);
    $update=mysqli_query($conn, "UPDATE customer SET pwd='$password' WHERE customer_id='$_SESSION[user_id]'");  
    if($update){
      echo "Password update successfully";
    }else{ echo "Failed to update password"; }
    }else{
      echo "Password mismatch";
    }
}
//end of change password
//delete saved address
else if(isset($_POST['address_delete_id'])){
  $dal=mysqli_query($conn,"DELETE FROM customer_address WHERE address_id='$_POST[address_delete_id]'");
  //echo "DELETE FROM customer_address WHERE address_id='$_POST[address_delete_id]'";
  if($dal){
    echo "1";
  }else{
    echo "0";
  }
}
//delete cart item
else if(isset($_POST['cart_delete'])){
  $cart=$_POST['cart_delete'];
  unset($_SESSION['cart'][$cart]);
 // echo "1";
  $grand_total=0;
  if(!empty($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
    $cart_qry=mysqli_query($conn,"SELECT final_price FROM products WHERE product_id='$key'");
    while($cart_row= mysqli_fetch_assoc($cart_qry)){
      $sub_tot=$value*$cart_row['final_price'];
      $grand_total=$grand_total+$sub_tot;
    }
  }
  echo json_encode(array('res'=>'1','grant'=> $grand_total));
  }else{
    echo json_encode(array('res'=>'1','grant'=> '0'));
  }
}
//Checkout load address
else if(isset($_POST['exist_address'])){
 $addr=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer_address WHERE address_id='$_POST[exist_address]'"));
 echo json_encode($addr);
}
// update cart in cart page
else if(isset($_POST['upcart'])){
  $prid=$_POST['upcart'];
  $quantity=$_POST['quantity'];

if(!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();
    }
if(array_key_exists($prid, $_SESSION['cart'])){
         $_SESSION['cart'][$prid]=$quantity;
    }else{
     $_SESSION['cart'][$prid]=$quantity;  
    }
$final_p=mysqli_fetch_array(mysqli_query($conn,"SELECT final_price FROM products WHERE product_id='$prid'"));
$single_price= $final_p['final_price']*$_SESSION['cart'][$prid];
$grand_total=0;
foreach ($_SESSION['cart'] as $key => $value) {
  $cart_qry=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$key'");
   while($cart_row= mysqli_fetch_assoc($cart_qry)){
    $sub_tot=$value*$cart_row['final_price']; 
    $grand_total=$grand_total+$sub_tot;
  }
}
echo json_encode(array('single_price'=>round($single_price, 2) ,'grand_price'=>round($grand_total, 2)));
    }
?>

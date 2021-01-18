<?php
session_start();
include('db.php');
if(isset($_SESSION['user_id'])){
   if(isset($_POST['prid'])){
    $prid=$_POST['prid'];
    $quantity=$_POST['quantity'];
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();
    }
    if(array_key_exists($prid, $_SESSION['cart'])){
         $_SESSION['cart'][$prid]=$_SESSION['cart'][$prid]+$quantity;
    }else{
     $_SESSION['cart'][$prid]=$quantity;  
    }
    echo $cart_count=count($_SESSION['cart']);

}elseif($_POST['status']=='apply_coupon'){
        if(isset($_POST['coupon'])){
            $query=mysqli_query($conn,"SELECT * FROM coupons WHERE coupon='$_POST[coupon]' AND exp_date>=NOW()");
            $numrow=mysqli_num_rows($query);
            if($numrow<1){
                $var= array('failure'=>"Invalid coupon code applied");
                echo json_encode($var);
            }else{
                $info=mysqli_fetch_array($query);
                if($_POST['subtotal']<$info['coupon_min_price']){

                    $q= "Buy more than INR ".$info['coupon_min_price']." for apply this code";
                    $var= array('failure'=>$q);
                echo json_encode($var);
                }else{					$_SESSION['coupon_status']="1";					
                    $price=$_POST['subtotal']-(($info['coupon_pecent']/100)* $_POST['subtotal']);					$_SESSION['coupon_price']=$price;
                    $var= array('success'=>round($price, 2),'coupon_percent'=>$info['coupon_pecent'],'msg'=>'Coupon applied');
                echo json_encode($var);
                }
            }

        }
    }
    }
    
 ?>

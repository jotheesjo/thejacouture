<?php session_start();
include('db.php');

if($_SESSION['user_type']!='guest'){
if($_POST['review']!='' && $_POST['summery']!='' && $_POST['pr_id']!=''){
	$q=mysqli_query($conn, "INSERT INTO product_review (cust_id, cust_name, pr_id, review_title, review, review_date) VALUES ('$_SESSION[user_id]','$_SESSION[user_name]','$_POST[pr_id]','$_POST[summery]', '$_POST[review]', NOW())");
   if($q){
   	echo "Your review accepted successfully. and waiting for approval";
   }else{
   	echo "Something went wrong try again";
   }
}else{
	echo "Please fill all mandatory fields";
}
   
    }else{
    	echo "You don't have an account";
    }
    
 ?>

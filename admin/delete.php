<?php include('init.php'); ?>
 <?php   
  if(isset($_POST['deletecat']))
  {
	  $ci = $_POST['catid']; 
	  
	$cusdel =$db->query("delete from category where id='$ci'");
if($cusdel)	
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_category.php?msg=Record Deleted Successfully';
    </SCRIPT>");
	
	else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_category.php?msg=Error While Deleting Record';
    </SCRIPT>");
	
  
  }
    
   elseif(isset($_POST['deletesubcat']))
  {
	  $si = $_POST['scatid']; 
	  
	$scdel =$db->query("delete from sub_category where id='$si'");
if($scdel)	
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Subcat Record Deleted.. ')
    window.location.href='view_subcategory.php';
    </SCRIPT>");
	
	else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Deleting.. ')
    window.location.href='view_subcategory.php';
    </SCRIPT>");
	
  
  }
  
  elseif(isset($_POST['deleteproduct']))
  {
    $pi = $_POST['proid']; 
    
  $prodel =$db->query("delete from products where product_id='$pi'");
if($prodel)  
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_product.php?msg=product deleted successfully';
    </SCRIPT>");
  
  else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_product.php?msg=Failed to  delete product';
    </SCRIPT>");  
  }



elseif(isset($_POST['deletemake']))
  {
    $di = $_POST['delid']; 
    
  $prodel =$db->query("delete from  make where id='$di'");

if($prodel)  
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Make  1 Record Deleted.. ')
    window.location.href='add_make.php';
    </SCRIPT>");
  
  else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Deleting.. ')
    window.location.href='add_make.php';
    </SCRIPT>");  
  }
  elseif(isset($_POST['deleteuom']))
  {
    $di = $_POST['delid']; 
    
  $prodel =$db->query("delete from  brands where id='$di'");

if($prodel)  
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add_brand.php';
    </SCRIPT>");
  
  else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Deleting.. ')
    window.location.href='add_brand.php';
    </SCRIPT>");  
  }

elseif(isset($_GET['deluser']))
  {
    $di = $_GET['deluser']; 
    
  $userdel =$db->query("delete from  users where id='$di'");

if($userdel)  
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('User  Deleted.. ')
    window.location.href='view_users.php';
    </SCRIPT>");
  
  else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error While Deleting.. ')
    window.location.href='view_users.php';
    </SCRIPT>");  
  }elseif(isset($_POST[deletecoupon])){
    $userdel =$db->query("delete from  coupons where id='$_POST[delid]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='coupon.php?msg=Coupon deleted successfully';
    </SCRIPT>");
  }else if(isset($_POST['deleteservicebrand'])){
    $userdel =$db->query("delete from service_brand where id='$_POST[delid]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add-service-brand.php';
    </SCRIPT>");
  }else if(isset($_POST['deletemodel'])){
    $userdel =$db->query("delete from service_model where id='$_POST[delid]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='add-service-models.php';
    </SCRIPT>");
  }
    elseif(isset($_POST['deleteproductreview']))
  {
    $pi = $_POST['proid']; 
    
  $prodel =$db->query("delete from product_review where review_id='$pi'");
if($prodel)  
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='reviews.php?msg=Review deleted successfully';
    </SCRIPT>");
  
  else
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='reviews.php?msg=Failed to  delete review';
    </SCRIPT>");  
  }else if(isset($_POST['delete_size'])){
    $userdel =$db->query("delete from variation_size where size_id='$_POST[size_id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_size.php?msg=Variation deleted successfully';
    </SCRIPT>");
  }else if(isset($_POST['delete_color'])){
    $userdel =$db->query("delete from variation_color where color_id='$_POST[color_id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_color.php?msg=Variation deleted successfully';
    </SCRIPT>");
  }else if(isset($_POST['delete_type'])){
    $userdel =$db->query("delete from variation_type where type_id='$_POST[type_id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_type.php?msg=Variation deleted successfully';
    </SCRIPT>");
  }else if(isset($_POST['delete_brand'])){
    $userdel =$db->query("delete from variation_brand where brand_id='$_POST[brand_id]'");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='view_brand.php?msg=Variation deleted successfully';
    </SCRIPT>");
  }

  ?>